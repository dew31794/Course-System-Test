<?php

namespace App\Transformers\ListLecturer;

use League\Fractal\TransformerAbstract;
use App\Models\Lecturer;

class LecturerTransformer extends TransformerAbstract
{
    // protected $defaultIncludes = [
    //     'course'
    // ];

    public function transform(Lecturer $lecturer)
    {
        return [
            'id' => $lecturer->id,
            'num' => $lecturer->num,
            'name' => $lecturer->name,
            'department' => $lecturer->department,
            'fulltime' => $lecturer->fulltime,
            'rank' => $lecturer->rank,
            'specialty' => $lecturer->specialty,
            'remark' => $lecturer->remark,
            // 'created_at' => $lecturer->created_at,
            // 'updated_at' => $lecturer->updated_at,
        ];
    }

    // public function includeCourse(Lecturer $lecturer)
    // {
    //     $course = $lecturer->course;
    //     return $this->item($course, new CourseListTransformer);
    // }
}
