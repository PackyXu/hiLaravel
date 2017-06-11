<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     * 是否任何人都可以编辑 默认为false
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 编辑表单验证规则
     * @return array
     */
    public function rules()
    {
        return [
            //编辑规则
            'title'=>'required|min:4|max:20',
            'content'=>'required|min:10|max:200',
            'published_art'=>'required'
        ];
    }
}
