<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderdocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdocuments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_id');
            $table->date('order_date');
            $table->string('parent_sku');
            $table->string('parent_num');
            $table->string('supplier')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('done');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderdocuments');
    }
}
