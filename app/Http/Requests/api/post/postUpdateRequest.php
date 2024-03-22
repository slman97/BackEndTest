<?php

namespace App\Http\Requests\api\post;

use Illuminate\Foundation\Http\FormRequest;

class postUpdateRequest extends FormRequest
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
            'id' =>['required', 'string', 'max:255'],
            'user_id' => ['required', 'string', 'max:255'],
            'caption' => ['required', 'string', 'max:255'],
            'discription' => ['required', 'string','max:1000'],
            'image' => 'required',
        ];
    }
}
