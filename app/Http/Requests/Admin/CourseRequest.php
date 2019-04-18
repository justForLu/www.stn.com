<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class CourseRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:30',
            'image' => 'required',
            'introduce' => 'required|max:20',
            'sort' => 'required|integer|min:0',
            'content' => 'required',


        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入教程标题',
            'title.max' => '教程标题最多30个字',
            'image.required' => '请上传图片',
            'introduce.required' => '请输入教程简介',
            'introduce.max' => '教程简介字数最多20个字',
            'sort.required' => '请输入排序',
            'sort.integer' => '排序必须为整数',
            'sort.min'  => '排序必须大于等于0',
            'content.required' => '请输入教程内容'
        ];
    }

}
