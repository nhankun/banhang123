<?php

namespace App\Http\Requests\Backs\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $id = isset($this->categories) ? ','.$this->categories : '';
        return [
            'name' => 'required|max:255|unique:categories,name'.$id,
//            'fileImage' => 'required|mimetypes:fileImage/jpeg,fileImage/png,fileImage/jpg|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'fileImage.image'  => 'The files must be a file image',
            'fileImage.mimetypes' => 'The files must be a file of type: jpeg,png,jpg.',
        ];
    }
}
