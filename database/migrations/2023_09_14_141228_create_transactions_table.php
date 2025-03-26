<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->id();

            $table->string('transaction_id')->nullable();
            $table->string('payment_gateway')->nullable();

            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('billing_id');
            $table->foreign('billing_id')
                  ->references('id')
                  ->on('billings')
                  ->onDelete('cascade');

            $table->double('amount');
            $table->string('currency')->nullable();
            $table->string('status');
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropForeign(['billing_id']);
            $table->dropColumn('billing_id');
        });
        Schema::dropIfExists('transactions');
    }
}
