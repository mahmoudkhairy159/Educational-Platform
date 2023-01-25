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
            $table->string('nationalId')->unique();
            $table->string('description_ar');
            $table->string('description_en');
            $table->string('gender');
            $table->string('governorate');
            $table->string('city');
            $table->string('photo');
            $table->integer('trainer_id');
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
