<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('regular_address');
            $table->dropColumn('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->string('avatar')->nullable();
            $table->string('regular_address', 255)->after('marital_status')->comment('Địa chỉ thường chú');
            $table->tinyInteger('status')->comment("1: Chưa xác nhận | 2: Xác nhận ")->after('experience');       
        });
    }
}
