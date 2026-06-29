<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cek apakah column sudah ada
        if (!Schema::hasColumn('orders', 'order_number')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('order_number')->nullable()->after('order_id');
            });
        }

        // Fill ALL rows dengan order_number yang unique (including NULL)
        $orders = DB::table('orders')->get();
        foreach ($orders as $order) {
            // Generate unique order_number jika belum ada
            $orderNumber = $order->order_number ?: ('ORD-' . date('YmdHis', strtotime($order->created_at)) . rand(10000, 99999));

            DB::table('orders')
                ->where('order_id', $order->order_id)
                ->update([
                    'order_number' => $orderNumber
                ]);
        }

        // Update column jadi NOT NULL
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')->nullable(false)->change();
        });

        // Tambah unique constraint
        Schema::table('orders', function (Blueprint $table) {
            $table->unique('order_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropUnique(['order_number']);
            $table->dropColumn('order_number');
        });
    }
};
