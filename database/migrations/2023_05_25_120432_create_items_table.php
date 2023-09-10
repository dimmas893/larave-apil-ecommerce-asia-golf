<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('number')->unique();
            $table->string('name');
            $table->integer('minimal_order')->default(1);
            $table->boolean('is_bestseller')->default(false);
            $table->string('gender');
            // $table->integer('brand_id');

            $table->bigInteger("brand_id")->unsigned();
            $table->foreign("brand_id")
                ->references("id")
                ->on("brands")
                ->onDelete("CASCADE")
                ->onUpdate("CASCADE");

            $table->integer('category_id');
            $table->float('weight');
            $table->float('price');
            $table->text('deskripsi');
            $table->softDeletes();
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