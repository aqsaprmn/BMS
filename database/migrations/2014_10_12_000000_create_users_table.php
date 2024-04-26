<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid("user_id")->unique();
            $table->string("role")->nullable();
            $table->string("position")->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('hp')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_admin')->default(false)->nullable();
            $table->char('status', 1)->nullable();
            $table->char('district', 1)->default("N")->nullable();
            $table->string('password')->nullable();
            $table->string('passwordable')->nullable();
            $table->string('image')->nullable()->default("404.jpg");
            $table->rememberToken()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
