<?php

// namespace Tests\Unit;

// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Tests\TestCase;
// use App\Models\Course;
// use App\Models\Lecturer;

// class CourseCreateTest extends TestCase
// {    
//     // 可以重整資料表，避免測試資料不斷累積。注意這會刪除所有資料，不要用在正式環境
//     // use RefreshDatabase;
//     /**
//      * A basic unit test example.
//      *
//      * @return void
//      */
//     public function test_db_can_create_course()
//     {
//         $totalCourses = Course::get('id')->count();

//         $data = [
//             'num' => '2302A099',
//             'name' => '測試性課程',
//             'credits' => '3',
//             'limit_people' => '99',
//             'classroom_and_time' => '測試學院 測試大樓101，週一 09:10',
//             'instructors' => 'P0099',
//             'limit_illustrate' => '限本校生',
//             'required_illustrate' => '資訊相關學系必修',
//             'remark' => '無',
//         ];
        
//         $course = Course::create($data);

//         $this->assertDatabaseCount('courses', $totalCourses + 1);

//         // Delete the product as need to keep it in database for other tests
//         $course = Course::where('num', '2302A099')->where('name', "測試性課程")->first();

//         $course->delete();
//     }
// }
