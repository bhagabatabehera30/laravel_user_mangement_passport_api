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
            $table->bigInteger('primary_role_id')->unsigned()->nullable()->after('status');
            $table->foreign('primary_role_id')->references('id')->on('user_roles')->onDelete('cascade')->onUpdate('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_primary_role_id_foreign');
           // $table->dropIndex('users_primary_role_id_index');
            $table->dropColumn('primary_role_id');
        });
    }
};
