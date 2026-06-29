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
        Schema::table('orders', function (Blueprint $table) {
        $table->string('shipping_method')->default('pickup'); // 'pickup' atau 'delivery'
        $table->text('shipping_address')->nullable(); // Alamat lengkap
        $table->string('receiver_name')->nullable(); // Nama penerima
        $table->string('receiver_phone')->nullable(); // No HP penerima
        $table->text('notes')->nullable(); // Catatan tambahan
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['shipping_method', 'shipping_address', 'receiver_name', 'receiver_phone', 'notes']);
    });
    }
};
