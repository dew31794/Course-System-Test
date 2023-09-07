<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;
use Str;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Course::truncate();
        Course::unguard();

        $datas = array(
            array(
                'num' => '2301A001',
                'name' => '專題演講',
                'credits' => '3',
                'limit_people' => '60',
                'classroom_and_time' => '管理學院 資訊大樓201，週二 13:10',
                'instructors' => 'P0001',
                'limit_illustrate' => '限資管系,資訊工程系',
                'required_illustrate' => '資訊相關學系必修',
                'remark' => '本課程有期中/期末發表',
            ),
            array(
                'num' => '2301A002',
                'name' => '資料結構',
                'credits' => '3',
                'limit_people' => '45',
                'classroom_and_time' => '管理學院 資訊大樓202，週一 09:10',
                'instructors' => 'P0001',
                'limit_illustrate' => '限資管系,資訊工程系',
                'required_illustrate' => '資訊相關學系必修',
                'remark' => '無',
            ),
            array(
                'num' => '2301B001',
                'name' => '電子學',
                'credits' => '3',
                'limit_people' => '40',
                'classroom_and_time' => '工程學院 電子系大樓201，週二 13:10',
                'instructors' => 'P0002',
                'limit_illustrate' => '限工程學院所有科系',
                'required_illustrate' => '電子系必修',
                'remark' => '本課程為18週課程',
            ),
            array(
                'num' => '2301C002',
                'name' => '多媒體設計',
                'credits' => '3',
                'limit_people' => '50',
                'classroom_and_time' => '創意媒體學院1館701，週四 13:10',
                'instructors' => 'P0003',
                'limit_illustrate' => '限多媒體學院',
                'required_illustrate' => '資訊傳播系必修',
                'remark' => '本課程需做成果展示',
            ),
            array(
                'num' => '2301D001',
                'name' => '中餐烹飪',
                'credits' => '3',
                'limit_people' => '25',
                'classroom_and_time' => '餐飲大樓501，週五 09:10',
                'instructors' => 'P0004',
                'limit_illustrate' => '限餐飲管理系',
                'required_illustrate' => '餐飲管理系必修',
                'remark' => '本課程為實作課程',
            ),
            array(
                'num' => '2301P001',
                'name' => '體育',
                'credits' => '1',
                'limit_people' => '100',
                'classroom_and_time' => '體育館，週三 14:10',
                'instructors' => 'P0005',
                'limit_illustrate' => '無',
                'required_illustrate' => '必修',
                'remark' => '本課程全校必修',
            )
        );

        foreach ($datas as $data) {
            Course::create($data);
        }
    }
}
