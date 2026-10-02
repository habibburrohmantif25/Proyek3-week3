<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    public function create(array $data, ?UploadedFile $poster = null): Activity
    {
        $data['status'] = 'draft';
        $data['registered_count'] = 0;

        if ($poster) {
            $data['poster_path'] = $poster->store('posters', 'public');
        }

        return Activity::create($data);
    }

    public function update(Activity $activity, array $data, ?UploadedFile $poster = null): Activity
    {
        unset($data['status'], $data['registered_count']);

        if ($poster) {
            if ($activity->poster_path && Storage::disk('public')->exists($activity->poster_path)) {
                Storage::disk('public')->delete($activity->poster_path);
            }
            $data['poster_path'] = $poster->store('posters', 'public');
        }

        $activity->update($data);

        return $activity->refresh();
    }

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw ValidationException::withMessages([
                'status' => 'Hanya kegiatan berstatus draft yang dapat dipublikasikan.',
            ]);
        }

        $requiredFields = ['category_id', 'code', 'title', 'location', 'start_at', 'end_at', 'capacity'];
        foreach ($requiredFields as $field) {
            if (empty($activity->{$field})) {
                throw ValidationException::withMessages([
                    'status' => "Kegiatan tidak dapat dipublikasikan karena field '{$field}' belum lengkap.",
                ]);
            }
        }

        if ($activity->end_at < $activity->start_at) {
            throw ValidationException::withMessages([
                'end_at' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            ]);
        }

        if ($activity->capacity < 1 || $activity->capacity > 500) {
            throw ValidationException::withMessages([
                'capacity' => 'Kapasitas harus antara 1 sampai 500 peserta.',
            ]);
        }

        $activity->update(['status' => 'published']);

        return $activity->refresh();
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'status' => 'Hanya kegiatan berstatus published yang dapat diselesaikan.',
            ]);
        }

        $activity->update(['status' => 'completed']);

        return $activity->refresh();
    }

    public function restore(int $id): Activity
    {
        $activity = Activity::onlyTrashed()->findOrFail($id);
        $activity->restore();

        return $activity;
    }

    public function registerParticipant(Activity $activity, array $data): Registration
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'activity' => 'Pendaftaran hanya dapat dilakukan untuk kegiatan yang telah dipublikasikan.',
            ]);
        }

        if (Carbon::now()->greaterThanOrEqualTo($activity->start_at)) {
            throw ValidationException::withMessages([
                'activity' => 'Pendaftaran ditolak karena kegiatan sudah dimulai atau telah lewat.',
            ]);
        }

        if ($activity->registered_count >= $activity->capacity) {
            throw ValidationException::withMessages([
                'capacity' => 'Pendaftaran ditolak karena kuota kapasitas kegiatan telah penuh.',
            ]);
        }

        $alreadyRegistered = $activity->registrations()
            ->where('email', $data['email'])
            ->exists();

        if ($alreadyRegistered) {
            throw ValidationException::withMessages([
                'email' => 'Email ini sudah terdaftar pada kegiatan ini.',
            ]);
        }

        return DB::transaction(function () use ($activity, $data) {
            $registration = $activity->registrations()->create([
                'participant_name' => $data['participant_name'],
                'email' => $data['email'],
                'registered_at' => Carbon::now(),
            ]);

            $activity->increment('registered_count');

            return $registration;
        });
    }
}