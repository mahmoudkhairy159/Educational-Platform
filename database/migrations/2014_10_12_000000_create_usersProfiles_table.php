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
            $table->string('nationalId')->unique();
            $table->string('gender');
            $table->string('governorate');
            $table->string('city');
            $table->string('educationType');
            $table->string('educationYear');
            $table->string('photo');
            $table->integer('user_id');
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
