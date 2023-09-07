<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Course;
use Laravel\Sanctum\Sanctum;

class CourseTest extends TestCase
{
    // use RefreshDatabase;
    // 測試1 檢查是否篩選的到課程列表
    public function test_course_list()
    {
        $this->json('GET',route('api.course.read'))
        ->assertStatus(200)
        ->assertJson([
            "Status" => "Success"
        ]);
    }

    // 測試2 檢查是否可以新增 P0099講師編號不存在的，基本上要不通過
    public function test_can_create_a_course()
    {
        $data = [
            'num' => '2302A099',
            'name' => '測試性課程',
            'credits' => '3',
            'limit_people' => '99',
            'classroom_and_time' => '測試學院 測試大樓101，週一 09:10',
            'instructors' => 'P0099',
            'limit_illustrate' => '限本校生',
            'required_illustrate' => '資訊相關學系必修',
            'remark' => '無',
        ];

        $response = $this->json('POST', route('api.course.create'),$data);

        $response
        ->assertStatus(422)
        ->assertJson([
            "Status" => "Failure",
            "ErrorMessage"=>[
                "instructors" => [
                    "講師編號不存在，請重新輸入。"
                ]
            ],
            "Code" => "422"
        ]);
    }
}
