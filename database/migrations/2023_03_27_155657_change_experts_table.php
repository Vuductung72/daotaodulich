<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('experts', function (Blueprint $table) {
            $table->dropColumn('describe');
            $table->dropColumn('certificate');
            $table->dropColumn('experience');
            $table->dropColumn('address');
            $table->bigInteger('course_id')->after('customer_id');
            $table->string('name', 255)->after('avatar');
            $table->date('birthday')->after('name')->nullable()->comment('Ngày,tháng,năm sinh');
            $table->tinyInteger('gender')->after('birthday')->comment('Giới tính');
            $table->string('nationality', 100)->after('gender')->comment('Quốc tịch');
            $table->tinyInteger('marital_status')->after('nationality')->comment('Tình trạng hôn nhân');
            $table->string('regular_address', 255)->after('marital_status')->comment('Địa chỉ thường chú');
            $table->string('current_address', 255)->after('regular_address')->comment('Địa chỉ hiện tại');
            $table->text('content')->after('current_address')->comment('Thông tin liên quan')->nullable();
            $table->text('social_network')->after('content')->comment('Mạng xã hội ')->nullable();
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
            $table->dropColumn('course_id');
            $table->dropColumn('fullname');
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('nationality');
            $table->dropColumn('marital_status');
            $table->dropColumn('regular_address');
            $table->dropColumn('current_address');
            $table->dropColumn('content');
            $table->dropColumn('social_network');
            $table->text('describe');
            $table->string('address');
            $table->string('certificate')->comment('Chứng chỉ');
            $table->string('experience')->comment('Kinh nghiệm');
        });
    }
}
