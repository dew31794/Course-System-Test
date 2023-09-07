<?php

namespace Database\Seeders;

use App\Models\Lecturer;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;
use Str;

class LecturerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Lecturer::truncate();
        Lecturer::unguard();

        $datas = array(
            array(
                'num' => 'P0001',
                'name' => '李專題',
                'department' => '資訊管理系',
                'fulltime' => '專任',
                'rank' => '助理教授',
                'specialty' => 'XXXXXXX',
                'remark' => '無',
            ),
            array(
                'num' => 'P0002',
                'name' => '黃電子',
                'department' => '電子工程系',
                'fulltime' => '專任',
                'rank' => '教授',
                'specialty' => 'XXXXXXX',
                'remark' => '無',
            ),
            array(
                'num' => 'P0003',
                'name' => '陳媒體',
                'department' => '資訊傳播系',
                'fulltime' => '專任',
                'rank' => '副教授',
                'specialty' => 'XXXXXXX',
                'remark' => '無',
            ),
            array(
                'num' => 'P0004',
                'name' => '陳小二',
                'department' => '餐飲管理系',
                'fulltime' => '兼任',
                'rank' => '講師',
                'specialty' => 'XXXXXXX',
                'remark' => '無',
            ),
            array(
                'num' => 'P0005',
                'name' => '黃運動',
                'department' => '運動休閒系',
                'fulltime' => '專任',
                'rank' => '助理教授',
                'specialty' => 'XXXXXXX',
                'remark' => '無',
            ),
        );

        foreach ($datas as $data) {
            Lecturer::create($data);
        }
    }
}
