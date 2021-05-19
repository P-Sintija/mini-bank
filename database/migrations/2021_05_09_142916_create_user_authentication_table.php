<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAuthenticationTable extends Migration
{

    public function up()
    {
        Schema::create('user_authentication', function (Blueprint $table) {
            $table->integer('id');
            $table->string('two_factor_code');
            $table->dateTime('two_factor_expires_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_authentication');
    }
}
