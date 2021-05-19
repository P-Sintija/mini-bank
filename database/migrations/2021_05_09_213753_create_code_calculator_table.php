<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeCalculatorTable extends Migration
{
    public function up()
    {
        Schema::create('code_calculator', function (Blueprint $table) {
            $table->integer('id');
            $table->string('code');
            $table->dateTime('expires_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('code_calculator');
    }
}
