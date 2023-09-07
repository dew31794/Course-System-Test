<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num')->unique()->comment('課程編號');
            $table->string('name')->comment('課程名稱');
            $table->integer('credits')->unsigned()->default(0)->comment('學分數');
            $table->integer('limit_people')->unsigned()->default(0)->comment('人數限制');
            $table->string('classroom_and_time')->nullable()->comment('教室與上課時間');
            $table->string('instructors')->index()->comment('授課教師');
            $table->string('limit_illustrate')->nullable()->comment('課程限制說明');
            $table->string('required_illustrate')->nullable()->comment('必選修說明');
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
        Schema::dropIfExists('courses');
    }
}
