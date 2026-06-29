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
        Schema::create('sph_headers', function (Blueprint $table) {
            $table->id('sph_id');
            $table->string('sph_number', 100)->unique();
            $table->date('sph_date');
            $table->string('client_name');
            $table->string('client_up')->nullable();
            $table->string('job_title')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_modal', 15, 2)->default(0);
            $table->integer('unit_multiplier')->default(1);
            $table->decimal('total_biaya', 15, 2)->default(0);
            $table->decimal('ppn_amount', 15, 2)->default(0);
            $table->decimal('pph_amount', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2)->default(0);
            $table->text('terms_waktu')->nullable();
            $table->text('terms_pembayaran')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sph_headers');
    }
};
