<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_markets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('raw_material_id');
            $table->string('measurement_amount')->default(1);
            $table->enum('measurement', ["GRAM", "KILO_GRAM", "LITER", "POUND", "PIECE"]);
            $table->float('payment_amount')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_markets');
    }
}
