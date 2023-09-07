<?php

namespace App\Transformers\ListLecturerRelationCourse;

use League\Fractal\TransformerAbstract;
use App\Models\Lecturer;

class LecturerTransformer extends TransformerAbstract
{
    protected array $defaultIncludes = [
        'children_course'
    ];

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

    public function includeChildrenCourse(Lecturer $lecturer)
    {
        $childrenCourse = $lecturer->childrenCourse()->orderBy('created_at', 'desc')->get();
        // return $this->collection($childrenCourse, new CourseTransformer);
        return $childrenCourse
        ? $this->collection($childrenCourse, new CourseTransformer, FALSE)
        : $this->null();
    }
}
