<?php

namespace App\Http\Requests\Backs\Providers;

use Illuminate\Foundation\Http\FormRequest;

class ProviderRequest extends FormRequest
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
        $id = isset($this->provider) ? ','.$this->provider : '';
        return [
            'name' => 'required|max:191|unique:providers,name'.$id,
            'fileImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'nullable|max:191',
            'email' => 'required|regex:/^.+@.+$/i|max:191',
            'tel' => 'required|max:20',
            'website' => 'required|max:191',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'fileImage.image'  => 'The files must be a file image',
            'fileImage.mimetypes' => 'The files must be a file of type: jpeg,png,jpg.',
            'email.regex' => 'The :attribute format is invalid.',
            'mimes' => 'The :attribute must be a file of type: :values.'
        ];
    }
}
