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
        Schema::table('guest_groups', function (Blueprint $table) {
            $table->integer('confirmed_count')->nullable();
            $table->string('confirmation_status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guest_groups', function (Blueprint $table) {
            $table->dropColumn(['confirmed_count', 'confirmation_status']);
        });
    }
};
