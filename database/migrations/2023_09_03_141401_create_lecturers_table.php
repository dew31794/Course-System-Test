<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num')->unique()->comment('講師編號');
            $table->string('name')->comment('授課講師');
            $table->string('department')->nullable()->comment('系所單位');
            $table->string('fulltime')->nullable()->comment('專兼任');
            $table->string('rank')->nullable()->comment('聘書職級');
            $table->string('specialty')->nullable()->comment('學術專長');
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
        Schema::dropIfExists('lecturers');
    }
}
