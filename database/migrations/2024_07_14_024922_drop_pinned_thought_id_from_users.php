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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['pinned_thought_id']);
            $table->dropColumn('pinned_thought_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('pinned_thought_id')->nullable()->after('id');
            $table->foreign('pinned_thought_id')->references('id')->on('thoughts')->onDelete('set null');
        });
    }
};
