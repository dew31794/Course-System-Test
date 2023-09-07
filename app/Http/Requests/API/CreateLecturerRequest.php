<?php

namespace App\Http\Requests\API;

use Illuminate\Support\Str;

class CreateLecturerRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'num'   => 'required|size:5|unique:lecturers',
            'name'  => 'required',
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
            'num.required'      => '請輸入講師編號。',
            'num.size'          => '講師編號需入8個字元',
            'num.unique'        => '講師編號已存在，請重新輸入。',
            'name.required'     => '請輸入授課講師。',
        ];
    }
}
