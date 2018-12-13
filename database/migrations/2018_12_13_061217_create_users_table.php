<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username', 15);
            $table->string('password');
            $table->string('role')->default('user');
            $table->string('image')->nullable();
            $table->boolean('gender')->nullable()->default(false);
            $table->integer('voice_type_id')->unsigned();
            $table->string('phone', 11)->nullable();
            $table->boolean('is_show_to_homepage')->default(false);
            $table->boolean('status')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('voice_type_id')->references('id')->on('voice_types')->onDelete('cascade');
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
