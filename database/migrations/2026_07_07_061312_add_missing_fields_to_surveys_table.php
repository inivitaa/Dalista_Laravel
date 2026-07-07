<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->string('nama')->after('guest_id')->nullable(); 

            $table->string('p1')->after('layanan_diakses')->nullable();
            $table->string('p2')->after('p1')->nullable();
            $table->string('p3')->after('p2')->nullable();
            $table->string('p4')->after('p3')->nullable();
            $table->string('p5')->after('p4')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('surveys', function (Blueprint $table) {
            $table->dropColumn(['nama', 'p1', 'p2', 'p3', 'p4', 'p5']);
        });
    }
};