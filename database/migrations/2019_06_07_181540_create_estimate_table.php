<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();;
            $table->decimal('operationCost',9 ,2)->nullable();;
            $table->decimal('tax', 9,2)->nullable();;
            $table->integer('customsCost')->nullable();;
            $table->decimal('lastMileCost', 9,2)->nullable();;
            $table->decimal('exchangeRate', 9,2)->nullable();;
            $table->decimal('total',9,2)->nullable();;
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
        Schema::dropIfExists('estimates');
    }
}
