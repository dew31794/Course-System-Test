<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Lecturer;

class LecturerTest extends TestCase
{
    // 測試3 確保查詢講師列表時，可以取得到課程資料
    public function test_lecturer_and_course_list()
    {
        $this->json('GET',route('api.lecturer.list-and-course'))
        ->assertStatus(200)
        ->assertJson([
            "Status" => "Success"
        ]);
    }
}
