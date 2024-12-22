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
        Schema::table('books', function (Blueprint $table) {
            $table->text('notes')->nullable()->change(); // Update from string to text and enable nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('notes', 255)->nullable(false)->change();
        });
    }
};
