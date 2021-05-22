<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvestmentAccountIdToBasicAccountsTable extends Migration
{

    public function up(): void
    {
        Schema::table('basic_accounts', function (Blueprint $table) {
            $table->integer('investment_account_id');
        });
    }


    public function down(): void
    {
        Schema::table('basic_accounts', function (Blueprint $table) {
            $table->dropColumn('investment_account_id');
        });
    }
}
