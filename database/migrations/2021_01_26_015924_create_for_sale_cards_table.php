<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForSaleCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('for_sale_cards', function (Blueprint $table) {
            $table->bigInteger('card_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->double('prize')->unsigned();
            $table->integer('stock')->unsigned();

            $table->timestamps();
        });

        Schema::table('for_sale_cards', function(Blueprint $table){
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
                
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('for_sale_cards');
    }
}
