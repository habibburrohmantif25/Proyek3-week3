<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $workshop = Category::where('slug', 'workshop')->first();
        $seminar = Category::where('slug', 'seminar')->first();
        $kompetisi = Category::where('slug', 'kompetisi')->first();

        $activities = [
            [
                'category_id' => $workshop->id,
                'code' => 'ACT-001',
                'title' => 'Workshop Git & GitHub Advanced',
                'description' => 'Mempelajari rebase, cherry-pick, dan resolusi conflict pada tim.',
                'start_at' => Carbon::now()->addDays(5)->setHour(9)->setMinute(0),
                'end_at' => Carbon::now()->addDays(5)->setHour(12)->setMinute(0),
                'location' => 'Lab Komputer 1',
                'capacity' => 40,
                'status' => 'published',
            ],
            [
                'category_id' => $workshop->id,
                'code' => 'ACT-002',
                'title' => 'Workshop Laravel RESTful API & Sanctum',
                'description' => 'Membangun arsitektur API modern dan autentikasi token.',
                'start_at' => Carbon::now()->addDays(7)->setHour(13)->setMinute(0),
                'end_at' => Carbon::now()->addDays(7)->setHour(16)->setMinute(0),
                'location' => 'Lab Komputer 2',
                'capacity' => 35,
                'status' => 'published',
            ],
            [
                'category_id' => $workshop->id,
                'code' => 'ACT-003',
                'title' => 'Workshop Docker untuk Pemula',
                'description' => 'Containerization aplikasi PHP dan MySQL secara efisien.',
                'start_at' => Carbon::now()->addDays(10)->setHour(10)->setMinute(0),
                'end_at' => Carbon::now()->addDays(10)->setHour(15)->setMinute(0),
                'location' => 'Lab Komputer 3',
                'capacity' => 30,
                'status' => 'draft',
            ],
            [
                'category_id' => $workshop->id,
                'code' => 'ACT-004',
                'title' => 'Workshop Tailwind CSS & Component Design',
                'description' => 'Menyusun design system yang konsisten menggunakan utility classes.',
                'start_at' => Carbon::now()->subDays(10)->setHour(8)->setMinute(0),
                'end_at' => Carbon::now()->subDays(10)->setHour(12)->setMinute(0),
                'location' => 'Lab Multimedia',
                'capacity' => 45,
                'status' => 'completed',
            ],
            [
                'category_id' => $workshop->id,
                'code' => 'ACT-005',
                'title' => 'Workshop Database Performance Tuning',
                'description' => 'Optimasi query index, explain plan, dan indexing PostgreSQL/MySQL.',
                'start_at' => Carbon::now()->addDays(15)->setHour(9)->setMinute(0),
                'end_at' => Carbon::now()->addDays(15)->setHour(13)->setMinute(0),
                'location' => 'Lab Komputer 1',
                'capacity' => 50,
                'status' => 'draft',
            ],
            [
                'category_id' => $seminar->id,
                'code' => 'ACT-006',
                'title' => 'Seminar AI and Future of Software Engineering',
                'description' => 'Tren AI coding assistant dan peran software engineer masa depan.',
                'start_at' => Carbon::now()->addDays(3)->setHour(8)->setMinute(30),
                'end_at' => Carbon::now()->addDays(3)->setHour(11)->setMinute(30),
                'location' => 'Auditorium Utama',
                'capacity' => 200,
                'status' => 'published',
            ],
            [
                'category_id' => $seminar->id,
                'code' => 'ACT-007',
                'title' => 'Seminar Cyber Security & Data Privacy',
                'description' => 'Praktik pencegahan kebocoran data dan mitigasi celah keamanan web.',
                'start_at' => Carbon::now()->addDays(8)->setHour(9)->setMinute(0),
                'end_at' => Carbon::now()->addDays(8)->setHour(12)->setMinute(0),
                'location' => 'Ruang Seminar Gedung C',
                'capacity' => 150,
                'status' => 'published',
            ],
            [
                'category_id' => $seminar->id,
                'code' => 'ACT-008',
                'title' => 'Seminar Cloud Native Architecture',
                'description' => 'Microservices, serverless, dan continuous delivery di cloud.',
                'start_at' => Carbon::now()->subDays(5)->setHour(13)->setMinute(0),
                'end_at' => Carbon::now()->subDays(5)->setHour(16)->setMinute(0),
                'location' => 'Auditorium Utama',
                'capacity' => 180,
                'status' => 'completed',
            ],
            [
                'category_id' => $seminar->id,
                'code' => 'ACT-009',
                'title' => 'Seminar Software Testing & Quality Assurance',
                'description' => 'Menerapkan TDD dan CI/CD pipeline untuk kehandalan produk.',
                'start_at' => Carbon::now()->addDays(12)->setHour(10)->setMinute(0),
                'end_at' => Carbon::now()->addDays(12)->setHour(12)->setMinute(0),
                'location' => 'Ruang Teater 1',
                'capacity' => 100,
                'status' => 'draft',
            ],
            [
                'category_id' => $seminar->id,
                'code' => 'ACT-010',
                'title' => 'Seminar Karier & Portofolio Developer',
                'description' => 'Bedah CV, portofolio proyek open source, dan persiapan interview teknis.',
                'start_at' => Carbon::now()->subDays(15)->setHour(9)->setMinute(0),
                'end_at' => Carbon::now()->subDays(15)->setHour(12)->setMinute(0),
                'location' => 'Auditorium Utama',
                'capacity' => 250,
                'status' => 'completed',
            ],
            [
                'category_id' => $kompetisi->id,
                'code' => 'ACT-011',
                'title' => 'Hackathon Web Development 2026',
                'description' => 'Kompetisi membangun aplikasi web inovatif selama 24 jam.',
                'start_at' => Carbon::now()->addDays(20)->setHour(8)->setMinute(0),
                'end_at' => Carbon::now()->addDays(21)->setHour(17)->setMinute(0),
                'location' => 'Hall Gedung Pusat',
                'capacity' => 120,
                'status' => 'published',
            ],
            [
                'category_id' => $kompetisi->id,
                'code' => 'ACT-012',
                'title' => 'Competitive Programming Contest',
                'description' => 'Uji kecepatan algoritma dan struktur data tingkat mahasiswa.',
                'start_at' => Carbon::now()->addDays(25)->setHour(9)->setMinute(0),
                'end_at' => Carbon::now()->addDays(25)->setHour(14)->setMinute(0),
                'location' => 'Lab Komputer 4 & 5',
                'capacity' => 80,
                'status' => 'published',
            ],
            [
                'category_id' => $kompetisi->id,
                'code' => 'ACT-013',
                'title' => 'UI/UX Design Challenge',
                'description' => 'Kompetisi perancangan antarmuka pengguna berbasis riset pengguna.',
                'start_at' => Carbon::now()->addDays(30)->setHour(8)->setMinute(0),
                'end_at' => Carbon::now()->addDays(30)->setHour(16)->setMinute(0),
                'location' => 'Studio Desain Grafis',
                'capacity' => 60,
                'status' => 'draft',
            ],
            [
                'category_id' => $kompetisi->id,
                'code' => 'ACT-014',
                'title' => 'CTF Cybersecurity Championship',
                'description' => 'Tantangan capture-the-flag seputar web security, cryptography, dan reverse engineering.',
                'start_at' => Carbon::now()->subDays(2)->setHour(9)->setMinute(0),
                'end_at' => Carbon::now()->subDays(1)->setHour(18)->setMinute(0),
                'location' => 'Lab Keamanan Jaringan',
                'capacity' => 70,
                'status' => 'completed',
            ],
            [
                'category_id' => $workshop->id,
                'code' => 'ACT-015',
                'title' => 'Workshop Code Refactoring & Clean Architecture',
                'description' => 'Menerapkan SOLID principles dan SonarQube static analysis.',
                'start_at' => Carbon::now()->addDays(6)->setHour(13)->setMinute(0),
                'end_at' => Carbon::now()->addDays(6)->setHour(17)->setMinute(0),
                'location' => 'Lab Komputer 1',
                'capacity' => 40,
                'status' => 'published',
            ],
        ];

        foreach ($activities as $act) {
            Activity::firstOrCreate(['code' => $act['code']], $act);
        }
    }
}