<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnToUserCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_customers', function (Blueprint $table) {
            $table->bigInteger('course_id')->default(0)->after('customer_id');
            $table->bigInteger('internship_id')->default(0)->after('course_id');
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
            $table->dropColumn('course_id');
            $table->dropColumn('internship_id');
        });
    }
}
