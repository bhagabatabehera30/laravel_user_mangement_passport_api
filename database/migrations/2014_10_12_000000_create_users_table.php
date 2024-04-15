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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 64);
            $table->string('last_name', 32)->nullable();
            $table->string('user_code', 32)->nullable();
            $table->string('email')->nullable();
            $table->string('country_code', 6)->nullable();
            $table->string('mobile', 15)->nullable();
            $table->string('label', 32)->nullable();
            $table->integer('status')->default(1);
            $table->bigInteger('creator_id')->unsigned()->nullable()->comment('This is used for SaaS');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
