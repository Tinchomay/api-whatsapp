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
        Schema::create('autos', function (Blueprint $table) {
            $table->id();
            $table->string('numde');
            $table->string('naciu');
            $table->string('tiden');
            $table->string('vemar');
            $table->string('vemol')->nullable();
            $table->string('vepla');
            $table->string('estde');
            $table->string('resIns');
            $table->string('insce');
            $table->string('nafis');
            $table->string('comsu');
            $table->string('estoc');
            $table->string('indpe');
            $table->string('indsu');
            $table->string('comsd');
            $table->string('ninfi');
            $table->date('dareg');
            $table->string('numof');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autos');
    }
};
