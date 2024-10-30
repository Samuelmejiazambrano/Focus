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
        Schema::table('cliente', function (Blueprint $table) {
            // Check if the 'plan' column exists before dropping it
            if (Schema::hasColumn('cliente', 'plan')) {
                $table->dropColumn('plan'); // Drop the column
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cliente', function (Blueprint $table) {
            $table->unsignedBigInteger('plan')->nullable();
        });
    }
    
};
