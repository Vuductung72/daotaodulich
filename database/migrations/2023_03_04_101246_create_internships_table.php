<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->text('describe');
            $table->text('profession_id');
            $table->smallInteger('quantity')->comment("Số lượng người tuyển");
            $table->integer('wage')->comment('Lương')->default(0);
            $table->tinyInteger('time')->comment('Thời gian thực tập');
            $table->string('address');
            $table->date('start_time')->comment('Thời gian bắt đầu thực tập');
            $table->tinyInteger('status')->comment("1: Chưa xác nhận | 2: Xác nhận ");
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
        Schema::dropIfExists('internship');
    }
}
