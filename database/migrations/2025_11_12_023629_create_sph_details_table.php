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
        Schema::create('sph_details', function (Blueprint $table) {
            $table->id('detail_id');
            $table->unsignedBigInteger('sph_id');
            $table->text('description');
            $table->decimal('quantity', 10, 2);
            $table->string('unit', 50);
            $table->decimal('total_price', 15, 2);
            $table->timestamps();

             $table->foreign('sph_id')
                  ->references('sph_id')
                  ->on('sph_headers')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sph_details');
    }
};
