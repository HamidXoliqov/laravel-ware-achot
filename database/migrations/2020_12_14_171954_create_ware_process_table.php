<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWareProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ware_process', function (Blueprint $table) {
            $table->id();
            $table->integer('ware_id');
            $table->integer('product_id');
            $table->integer('price');
            $table->integer('count');
            $table->integer('item_number')->nullable();            
            $table->string('status');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('ware_process');
    }
}
