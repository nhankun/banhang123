<?php

namespace App\Http\Requests\Backs\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = isset($this->product) ? ','.$this->product : '';
        return [
            'category_id' => 'required|numeric',
            'provider_id' => 'required|numeric',
            'name' => 'required|max:191|unique:products,name'.$id,
            'quantity' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'description' => 'nullable'
        ];
    }
}
