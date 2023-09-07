<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturerAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturer_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lecturer_num')->unique()->comment('講師編號');
            $table->string('password')->comment('講師密碼');
            $table->integer('status')->default(1)->comment('狀態【0=尚未啟用、1=啟用、2=停用、3=黑名單、9=刪除');
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
        Schema::dropIfExists('lecturer_accounts');
    }
}
