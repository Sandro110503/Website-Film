<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->float('rating_imdb', 3, 1)->nullable()->after('genre'); 
        });
    }

    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn('rating_imdb');
        });
    }
};
