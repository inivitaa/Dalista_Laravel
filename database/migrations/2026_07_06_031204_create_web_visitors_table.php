<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('web_visitors', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->string('ip_address', 45)->nullable();
            $blueprint->string('device_type')->default('Desktop');
            $blueprint->string('browser')->nullable();
            $blueprint->string('platform')->nullable();
            $blueprint->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('web_visitors');
    }
};