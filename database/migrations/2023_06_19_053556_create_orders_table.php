<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->integer('customer_id');
            $table->integer('address_id');
            $table->float('subtotal');
            $table->float('discount');
            $table->float('tax');
            $table->float('shipping_fee');
            $table->float('total');
            $table->date('date_checkout');
            $table->timestamp('end_paid');
            $table->string('number_paid');
            $table->string('method');
            $table->text('note');
            $table->enum('status', ['selesai', 'tiba di tujuan', 'dibatalkan', 'sedang dikirim', 'paid', 'unpaid']);
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
        Schema::dropIfExists('orders');
    }
}
