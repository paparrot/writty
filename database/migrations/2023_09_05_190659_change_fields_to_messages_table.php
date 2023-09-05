<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('user_from');
            $table->dropColumn('user_to');

            $table->foreignUuid('author_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreignUuid('conversation_id')
                ->references('id')
                ->on('conversations')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('author_id');
            $table->dropColumn('conversation_id');

            $table->foreignUuid('user_from')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreignUuid('user_to')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }
};
