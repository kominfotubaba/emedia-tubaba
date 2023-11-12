<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahuns', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('register')->default('0');
            $table->integer('order');
            $table->integer('pengajuan');
            $table->integer('pengajuan_edit');
            $table->integer('verifikasi');
            $table->integer('data');
            // $table->integer('murni')->default('0');
            // $table->integer('perubahan')->default('0');
            // $table->integer('total')->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahuns');
    }
};
