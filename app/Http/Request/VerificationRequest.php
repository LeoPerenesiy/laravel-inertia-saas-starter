<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

final class VerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Id is required',
        ];
    }
}
