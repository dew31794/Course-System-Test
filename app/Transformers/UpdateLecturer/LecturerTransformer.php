<?php

namespace App\Transformers\UpdateLecturer;

use League\Fractal\TransformerAbstract;
use App\Models\Lecturer;

class LecturerTransformer extends TransformerAbstract
{
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
}
