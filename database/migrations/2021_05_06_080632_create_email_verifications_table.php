<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailVerificationsTable extends Migration
{
    public function up()
    {
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->string('email');
            $table->timestamps();
            $table->dateTime('expires_at', $precision = 0)->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('SSN');
            $table->integer('balance');
            $table->string('currency');
            $table->string('password');
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_verifications');
    }

}
