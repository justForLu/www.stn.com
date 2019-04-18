<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class CheckCategoryRequest extends Request
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
            'name' => 'required|max:20|unique:check_category,name,'.$this->id.'id',
            'sort' => 'required|integer|min:0',

        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'name.required' => '请输入自检类型',
            'name.max'  => '自检分类标题最多20个字',
            'name.unique' => '自检类型不能重复',
            'sort.required' => '请输入排序',
            'sort.integer' => '排序必须为整数',
            'sort.min'  => '排序必须大于等于0',
        ];
    }

}
