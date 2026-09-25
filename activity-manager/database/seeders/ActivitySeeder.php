<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::query()->insert([
            [
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sprint Planning Proyek 3',
                'description' => 'Pembagian backlog dan task.',
                'activity_date' => '2026-10-15',
                'category' => 'Meeting',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Refactoring Modul 2',
                'description' => 'Pembersihan kode JavaScript lama.',
                'activity_date' => '2026-10-01',
                'category' => 'Development',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Evaluasi Kualitas Kode',
                'description' => 'Analisis hasil SonarQube sesi pertama.',
                'activity_date' => '2026-10-20',
                'category' => 'Evaluation',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}