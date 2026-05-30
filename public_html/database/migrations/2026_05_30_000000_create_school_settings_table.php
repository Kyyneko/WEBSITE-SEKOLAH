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
        Schema::create('school_settings', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('npsn');
            $table->string('akreditasi');
            $table->string('kurikulum');
            $table->string('status_sekolah');
            $table->string('bentuk_pendidikan');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('dapodik_link');
            $table->string('kepsek_name');
            $table->string('kepsek_photo_path')->nullable();
            $table->text('kepsek_welcome_text');
            $table->text('visi');
            $table->text('misi');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_settings');
    }
};
