<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\StoreRegistrationRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Category;
use App\Services\ActivityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $activities = Activity::query()
            ->with('category')
            ->search($request->query('search'))
            ->filterCategory($request->query('category_id'))
            ->filterStatus($request->query('status'))
            ->sortByDate($request->query('sort', 'newest'))
            ->paginate(10)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('activities.index', compact('activities', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('activities.create', compact('categories'));
    }

    public function store(
        StoreActivityRequest $request,
        ActivityService $service
    ): RedirectResponse {
        $activity = $service->create($request->validated(), $request->file('poster'));

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil dibuat dalam status draft.');
    }

    public function show(Activity $activity): View
    {
        $activity->load(['category', 'registrations']);

        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        $categories = Category::orderBy('name')->get();

        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(
        UpdateActivityRequest $request,
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        $service->update($activity, $request->validated(), $request->file('poster'));

        return to_route('activities.show', $activity)
            ->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil dipindahkan ke tempat sampah (soft delete).');
    }

    public function publish(Activity $activity, ActivityService $service): RedirectResponse
    {
        try {
            $service->publish($activity);
            return back()->with('success', 'Kegiatan berhasil dipublikasikan.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function complete(Activity $activity, ActivityService $service): RedirectResponse
    {
        try {
            $service->complete($activity);
            return back()->with('success', 'Kegiatan berhasil ditandai selesai.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors());
        }
    }

    public function trash(): View
    {
        $trashedActivities = Activity::onlyTrashed()
            ->with('category')
            ->latest('deleted_at')
            ->paginate(10);

        return view('activities.trash', compact('trashedActivities'));
    }

    public function restore(int $id, ActivityService $service): RedirectResponse
    {
        $activity = $service->restore($id);

        return to_route('activities.index')
            ->with('success', "Kegiatan '{$activity->title}' berhasil dipulihkan (restore).");
    }

    public function register(
        StoreRegistrationRequest $request,
        Activity $activity,
        ActivityService $service
    ): RedirectResponse {
        try {
            $service->registerParticipant($activity, $request->validated());

            return back()->with('success', 'Pendaftaran berhasil dikonfirmasi.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}