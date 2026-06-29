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
        Schema::table('sph_headers', function (Blueprint $table) {
        // Menambahkan kolom design_image setelah rincian_image
        $table->string('design_image')->nullable()->after('rincian_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sph_headers', function (Blueprint $table) {
        $table->dropColumn('design_image');
        });
    }
};
