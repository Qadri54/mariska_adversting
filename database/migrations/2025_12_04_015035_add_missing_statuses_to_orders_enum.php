<?php
// app/Http/Controllers/Customer/OrderController.php

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
        // SINTAKS SQL HARUS BERSIH TANPA KOMENTAR
        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'Pending',
                'Awaiting Approval',
                'Verified',
                'Processing',
                'Ready_for_pickup',
                'Completed',
                'Rejected',
                'Cancelled'
            ) NOT NULL DEFAULT 'Pending';
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // SINTAKS SQL HARUS BERSIH TANPA KOMENTAR
        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'Pending',
                'Processing',
                'Completed',
                'Cancelled'
            ) NOT NULL DEFAULT 'Pending';
        ");
    }
};
