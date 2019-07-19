<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('morder')->default('0');
            $table->string('code')->default('OL');
            $table->date('date')->default('1990-01-01');
            $table->string('description')->default('');
            $table->float('incoming')->default('0.00');
            $table->float('outgoing')->default('0.00');
            $table->float('runbal')->default('0.00');
            $table->text('notes');
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
        Schema::dropIfExists('budget');
    }
}
