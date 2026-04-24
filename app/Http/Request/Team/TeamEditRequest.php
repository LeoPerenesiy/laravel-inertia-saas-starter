<?php

namespace App\Http\Request\Team;

use Illuminate\Foundation\Http\FormRequest;

class TeamEditRequest extends FormRequest
{
    public function authorize(): bool
    {
        $team = $this->route('team');

        return $team && $team->owner_id === $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Team name is required.',
            'name.string' => 'Team name must be a string.',
            'name.max' => 'Team name must not exceed 255 characters.',
            'name.min' => 'Team name must be min 3 characters.',
        ];
    }
}
