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
        if (Schema::hasTable('books') && Schema::hasColumn('books', 'time')) {
            Schema::table('books', function (Blueprint $table) {
                $table->time('time')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('books') && Schema::hasColumn('books', 'time')) {
            Schema::table('books', function (Blueprint $table) {
                $table->string('time')->change();
            });
        }
    }
};
