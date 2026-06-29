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
        Schema::table('products', function (Blueprint $table) {
        // Tambah kolom 'finishing_options' jika belum ada
        if (!Schema::hasColumn('products', 'finishing_options')) {
            $table->json('finishing_options')->nullable()->after('image_url');
        }

        // Tambah kolom 'material_options' jika belum ada (INI YANG BIKIN ERROR TADI)
        if (!Schema::hasColumn('products', 'material_options')) {
            $table->json('material_options')->nullable()->after('finishing_options');
        }

        // Tambah kolom 'profit_margin' jika belum ada
        if (!Schema::hasColumn('products', 'profit_margin')) {
            $table->integer('profit_margin')->default(20)->after('base_price');
        }

        // Tambah kolom 'description' jika belum ada
        if (!Schema::hasColumn('products', 'description')) {
            $table->text('description')->nullable()->after('nama_produk');
        }
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['finishing_options', 'material_options', 'profit_margin', 'description']);
    });
    }
};
