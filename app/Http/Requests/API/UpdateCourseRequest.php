<?php

namespace App\Http\Requests\API;

use Illuminate\Support\Str;

class UpdateCourseRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'num'           => 'required|size:8|unique:courses',
            'name'          => 'required',
            'credits'       => 'integer|required',
            'limit_people'  => 'integer|required',
            'instructors'   => 'required|exists:lecturers,num',
        ];
    }

    /**
     * Individually verified callback messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'num.required'      => '請輸入課程編號。',
            // 'num.size'          => '課程編號需入8個字元',
            // 'num.unique'        => '課程編號已存在，請重新輸入。',
            'name.required'     => '請輸入課程名稱。',
            'credits.integer'   => '學分數請輸入數字。',
            'credits.required'  => '請輸入學分數。',
            'limit_people.integer'  => '人數限制請輸入數字。',
            'limit_people.required' => '請輸入人數限制。',
            'instructors.required'  => '請輸入講師編號。',
            'instructors.exists'    => '講師編號不存在，請重新輸入。',
        ];
    }
}
