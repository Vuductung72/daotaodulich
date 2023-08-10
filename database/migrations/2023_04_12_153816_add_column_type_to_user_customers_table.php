<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTypeToUserCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_customers', function (Blueprint $table) {
            $table->tinyInteger('type')->comment('0: Chọn chuyên gia | 1: Ứng tuyển')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_customers', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
