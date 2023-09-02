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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')
                ->unique(false)
                ->nullable(true)
                ->change();

            $table->string('nickname')
                ->unique(false)
                ->change();

            $table->string('oauth_id')->nullable();
            $table->string('oauth_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')
                ->nullable(false)
                ->change();
            $table->dropColumn('oauth_id');
            $table->dropColumn('oauth_type');
        });
    }
};
