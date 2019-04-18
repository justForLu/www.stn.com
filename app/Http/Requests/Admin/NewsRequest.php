<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class NewsRequest extends Request
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
            'title' => 'required|max:50',
            'image' => 'required',
            'introduce' => 'required|max:100',
            'content' => 'required',

        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入新闻标题',
            'title.max' => '新闻标题最多50个字',
            'image.required' => '请上传图片',
            'introduce.required' => '请输入新闻简介',
            'introduce.max' => '新闻简介字数最多100个字',
            'content.required' => '请输入新闻详情',
        ];
    }

}
