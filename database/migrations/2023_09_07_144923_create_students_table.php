<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num')->unique()->comment('學生編號');
            $table->string('password')->comment('學生密碼');
            $table->string('name')->comment('學生姓名');
            $table->string('department')->nullable()->comment('系所單位');
            $table->integer('status')->default(1)->comment('帳號狀態【0=尚未啟用、1=啟用、2=停用、3=黑名單、9=刪除');
            $table->text('remark')->nullable()->comment('備註');
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
        Schema::dropIfExists('students');
    }
}
