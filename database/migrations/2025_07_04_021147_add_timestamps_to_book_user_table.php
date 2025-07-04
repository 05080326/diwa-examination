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
        Schema::table('book_user', function (Blueprint $table) {
            $table->timestamps()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('book_user', 'created_at') && Schema::hasColumn('book_user', 'updated_at')) {
            Schema::table('book_user', function (Blueprint $table) {
                $table->dropColumn('created_at');
                $table->dropColumn('updated_at');
            });
        }
    }
};
