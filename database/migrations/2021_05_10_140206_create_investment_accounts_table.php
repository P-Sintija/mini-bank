<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('investment_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('basic_account_id');
            $table->string('User_ID');
            $table->string('name');
            $table->string( 'surname');
            $table->integer('investment_amount');
            $table->integer( 'actual_balance');
            $table->string('account_number');
            $table->string('currency');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('investment_accounts');
    }
}
