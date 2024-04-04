<?php

namespace App\Http\Requests\api\product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' =>['required', 'string', 'max:255'],
            'user_id' => ['required', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:255'],
            'discription' => ['required', 'string','max:1000'],
            'image' => 'required',
        ];
    }
}
