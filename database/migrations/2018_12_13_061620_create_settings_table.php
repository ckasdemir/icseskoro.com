<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->text('address');
            $table->string('mobile', 11)->nullable();
            $table->string('email')->nullable();
            $table->string('logo');
            $table->text('map')->nullable();
            $table->boolean('work_days_1')->nullable()->default(false);
            $table->boolean('work_days_2')->nullable()->default(false);
            $table->boolean('work_days_3')->nullable()->default(false);
            $table->boolean('work_days_4')->nullable()->default(false);
            $table->boolean('work_days_5')->nullable()->default(false);
            $table->boolean('work_days_6')->nullable()->default(false);
            $table->boolean('work_days_7')->nullable()->default(false);
            $table->time('work_start_time')->nullable();
            $table->time('work_end_time')->nullable();
            $table->string('facebook')->nullable()->default("#");
            $table->string('twitter')->nullable()->default("#");
            $table->string('instagram')->nullable()->default("#");
            $table->string('youtube')->nullable()->default("#");
            $table->string('vimeo')->nullable()->default("#");
            $table->string('soundcloud')->nullable()->default("#");
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
        Schema::dropIfExists('settings');
    }
}
