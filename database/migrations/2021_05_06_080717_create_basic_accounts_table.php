<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('basic_accounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('surname');
            $table->string('SSN');
            $table->string('email');
            $table->string('hash');
            $table->integer('balance');
            $table->string('User_ID');
            $table->string('account_number');
            $table->string('currency');
        });
    }


    public function down()
    {
        Schema::dropIfExists('basic_accounts');
    }

}
