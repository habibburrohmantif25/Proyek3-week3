<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('code', 30)->unique()->after('category_id');
            $table->string('title', 150)->change();
            $table->dateTime('start_at')->after('description');
            $table->dateTime('end_at')->after('start_at');
            $table->string('location')->after('end_at');
            $table->unsignedInteger('capacity')->after('location');
            $table->string('status', 20)->default('draft')->change();
            $table->string('poster_path')->nullable()->after('status');
            $table->unsignedInteger('registered_count')->default(0)->after('poster_path');
            $table->softDeletes()->after('updated_at');

            $table->dropColumn(['activity_date', 'category']);
        });
    }
    public function down(): void
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->date('activity_date')->nullable();
            $table->string('category', 50)->nullable();
            $table->dropSoftDeletes();
            $table->dropColumn([
                'code',
                'start_at',
                'end_at',
                'location',
                'capacity',
                'poster_path',
                'registered_count',
            ]);
        });
    }
};
