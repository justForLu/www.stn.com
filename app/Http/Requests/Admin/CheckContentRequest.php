<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;

class CheckContentRequest extends Request
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
            'title' => 'required|max:30|unique:check_content,title,'.$this->id.'id',
            'symptom' => 'required|max:200',
            'details' => 'required|max:200',
            'solve' => 'required|max:200',
            'prompt' => 'max:200',
            'type_first_id' => 'required',
            'type_second_id' => 'required',
            'fault' => 'integer|min:1|unique:check_content,fault,'.$this->id.'id',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return  [
            'title.required' => '请输入自检标题',
            'title.max' => '自检标题最多30个字',
            'title.unique' => '自检标题不能重复',
            'symptom.required' => '请输入问题症状',
            'symptom.max' => '问题症状字数不能超过200字',
            'details.required' => '请输入问题详情',
            'details.max' => '问题详情字数不能超过200字',
            'solve.required' => '请输入解决方案',
            'solve.max' => '解决方案字数不能超过200字',
//            'prompt.required' => '请输入安全提示',
            'prompt.max' => '安全提示字数不能超过200字',
            'type_first_id.required' => '请选择第一个关联类型',
            'type_second_id.required' => '请选择第二个关联类型',
//            'fault.required' => '请输入关联故障码',
            'fault.integer' => '关联故障码必须是数字',
            'fault.min' => '关联故障码必须大于0',
            'fault.unique' => '已存在的故障码',

        ];
    }

}
