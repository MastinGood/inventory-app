<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('branchid');
            $table->string('type', 50);
            $table->string('photo')->nullable();
            $table->string('name', 50);
            $table->string('item_code',20)->unique();
            $table->integer('price');
            $table->longText('description');
            $table->string('addedby', 20);
            $table->string('status', 2);
            $table->string('addedat');
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
        Schema::dropIfExists('items');
    }
}
