<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
		// 105 認証はtrueに変更する（デフォルトはfalse）
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
			// 105 以下のようにバリデーションを記載する事ができる。
			// 詳細はhttps://readouble.com/laravel/6.x/ja/validation.html
			'your_name'	=> 'required|string|max:20',
			'title'		=> 'required|string|max:50',
			'email'		=> 'required|email|unique:users|max:255',
			'url'		=> 'url|nullable',
			'gender'	=> 'required',
			'age'		=> 'required',
			'contact'	=> 'required|string|max:200',
			'caution'	=> 'required|accepted',
        ];
    }
}
