<?php

namespace App\Http\Requests\post;

use Illuminate\Foundation\Http\FormRequest;

class postStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|string',
            'caption' => 'required|string',
            'discription' => 'required|string',
            'image' =>'required'
        ];
    }
}
