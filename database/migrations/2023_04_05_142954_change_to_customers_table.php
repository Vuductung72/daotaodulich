<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('password');
            $table->string('description', 255)->nullable()->after('avatar');
            $table->string('regular_address', 255)->nullable()->comment('Địa chỉ thường trú')->after('description');
            $table->tinyInteger('status')->comment('1: Chưa xác nhận | 2: Xác nhận')->default(1)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('description');
            $table->dropColumn('regular_address');
        });
    }
}
