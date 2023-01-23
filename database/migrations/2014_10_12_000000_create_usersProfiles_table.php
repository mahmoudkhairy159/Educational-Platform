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
        // 'user_id','governorate','city','gender','nationalId','educationType','educationYear','photo'
        Schema::create('usersProfiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('governorate');
            $table->string('city');
            $table->string('gender');
            $table->string('nationalId')->unique();
            $table->string('educationType');
            $table->string('educationYear');
            $table->string('photo');
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
