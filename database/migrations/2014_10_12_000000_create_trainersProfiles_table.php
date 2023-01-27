<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'user_id','governorate','city','gender','nationalId','educationType','educationYear','photo'
        Schema::create('trainersProfiles', function (Blueprint $table) {
            $table->id();
            $table->string('nationalId')->unique()->nullable();
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->string('gender')->nullable();
            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->string('job')->nullable();
            $table->string('photo')->nullable();
            $table->integer('trainer_id');
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
        Schema::dropIfExists('trainersProfiles');
    }
}
