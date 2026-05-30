<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('school_settings', function (Blueprint $table) {
            $table->string('hero_subtitle')->default('Membentuk Generasi Cerdas, Berkarakter, dan Berprestasi');
            $table->text('hero_description')->nullable();
            $table->string('about_title')->default('Profil Singkat Sekolah');
            $table->text('about_description')->nullable();
            $table->string('history_title')->default('Sejarah Sekolah');
            $table->text('history_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_subtitle',
                'hero_description',
                'about_title',
                'about_description',
                'history_title',
                'history_description'
            ]);
        });
    }
};
