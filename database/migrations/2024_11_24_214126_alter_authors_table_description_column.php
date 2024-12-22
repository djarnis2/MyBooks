<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->text('description')->change(); // Update from string to text
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->string('description', 255)->change();
        });
    }
};
