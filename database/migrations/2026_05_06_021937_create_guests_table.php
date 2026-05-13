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
    Schema::create('guests', function (Blueprint $table) {
        $table->id();

        // data diri
        $table->string('nama');
        $table->string('email');
        $table->string('nohp');
        $table->string('jk');
        $table->text('alamat');

        // informasi tambahan
        $table->string('profesi');
        $table->string('pendidikan');
        $table->string('instansi')->nullable();

        // kunjungan
        $table->string('tujuan');
        $table->string('informasi');
        $table->text('keterangan');

        // upload
        $table->string('file_upload')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
