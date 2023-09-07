<?php

namespace App\Transformers\ListLecturerRelationCourse;

use League\Fractal\TransformerAbstract;
use App\Models\Course;

class CourseTransformer extends TransformerAbstract
{
    public function transform(Course $course)
    {
        $params = [
            'id' => $course->id,
            'num' => $course->num,
            'name' => $course->name,
            'credits' => $course->credits,
            'limit_people' => $course->limit_people,
            'classroom_and_time' => $course->classroom_and_time,
            'instructors' => $course->lecturer->name,
            'limit_illustrate' => $course->limit_illustrate,
            'required_illustrate' => $course->required_illustrate,
            'remark' => $course->remark,
            // 'created_at' => $course->created_at,
            // 'updated_at' => $course->updated_at,
        ];
        
        return $params;
    }
}
