<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('school_settings', function (Blueprint $table) {
            $table->string('hero_photo_1')->nullable()->after('history_description');
            $table->string('hero_photo_2')->nullable()->after('hero_photo_1');
            $table->string('hero_photo_3')->nullable()->after('hero_photo_2');
            $table->string('profile_banner_photo')->nullable()->after('hero_photo_3');
        });
    }

    public function down(): void
    {
        Schema::table('school_settings', function (Blueprint $table) {
            $table->dropColumn(['hero_photo_1', 'hero_photo_2', 'hero_photo_3', 'profile_banner_photo']);
        });
    }
};
