<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->string('payment_desc')->nullable();
            $table->string('comment')->nullable();
            $table->string('payment_method')->default('stripe')->nullable();
            $table->decimal('amount', 8, 2)->unsigned();
            $table->decimal('discount', 8, 2)->unsigned();
            $table->decimal('total_amt', 8, 2)->unsigned();
            $table->string('transaction_id')->nullable();
            $table->timestamp('purchase_time')->nullable();
            $table->timestamp('started_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->string('doneby')->default('system');
            $table->timestamps();

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
        Schema::dropIfExists('subscriptions');
    }
}
