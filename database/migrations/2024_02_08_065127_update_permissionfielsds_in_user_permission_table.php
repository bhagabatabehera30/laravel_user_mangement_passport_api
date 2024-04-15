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
        Schema::table('user_role_permissions', function (Blueprint $table) {
            $table->string('module_key')->nullable()->after('module_id');
            $table->integer('is_view')->default(0)->after('module_key');
            $table->integer('is_edit')->default(0)->after('is_view');
            $table->integer('is_create')->default(0)->after('is_edit');
            $table->integer('is_delete')->default(0)->after('is_create');
            $table->string('custom_keys')->nullable()->after('is_delete');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_role_permissions', function (Blueprint $table) {
            $table->dropColumn('module_key');
            $table->dropColumn('is_view');
            $table->dropColumn('is_edit');
            $table->dropColumn('is_create');
            $table->dropColumn('is_delete');
            $table->dropColumn('custom_keys');
        });
    }
};
