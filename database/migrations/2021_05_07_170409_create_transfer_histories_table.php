<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('transfer_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('debit_id');
            $table->string('debit_User_ID');
            $table->string('debit_account_number');
            $table->integer('debit_amount');
            $table->integer('credit_id');
            $table->string('credit_User_ID');
            $table->string('credit_account_number');
            $table->integer('credit_amount');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfer_histories');
    }
}
