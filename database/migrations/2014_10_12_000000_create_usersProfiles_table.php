<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersProfiles', function (Blueprint $table) {
            $table->id();
            $table->string('nationalId')->unique()->nullable();
            $table->string('gender')->nullable();
            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->string('educationType')->nullable();
            $table->string('educationYear')->nullable();
            $table->string('photo')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('usersProfiles');
    }
}
