<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->tinyInteger('user_type')->comment("1=admin,2=user")->default(2);
            $table->bigInteger('otp')->nullable();
            $table->bigInteger('mo_no')->nullable();
            $table->string('image')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->string('surname')->nullable();
            $table->boolean('is_subscribe')->default(false);


            $table->rememberToken();
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
}
