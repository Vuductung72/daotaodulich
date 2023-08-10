<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('method');
            $table->bigInteger('user_id');
            $table->bigInteger('transaction_id')->nullable();
            $table->text('order_code')->nullable();
            $table->integer('error_code')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 : Lỗi | 1 : Thành công');
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
        Schema::dropIfExists('payments');
    }
}
