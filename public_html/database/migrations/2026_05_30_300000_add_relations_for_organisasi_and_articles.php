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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('organisasi_id')->nullable()->after('subject_id');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->unsignedBigInteger('organisasi_id')->nullable()->after('author_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('organisasi_id');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('organisasi_id');
        });
    }
};
