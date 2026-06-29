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
    Schema::create('customer_secrets', function (Blueprint $table) {
        $table->id();
        // Kolom-kolom untuk menyimpan hasil enkripsi
        $table->string('encrypted_name');
        $table->string('encrypted_email');
        $table->string('encrypted_phone');
        $table->string('encrypted_address');
        $table->timestamp('generated_at');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_secrets');
    }
};
