<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFocusSettingsRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'duration_minutes' => ['sometimes', 'integer', 'min:5', 'max:120'],
            'session_notes' => ['sometimes', 'nullable', 'string', 'max:500']
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if (!$this->hasAny(['duration_times', 'session_notes'])) {
                $validator->errors()->add('general', 'At least one field must be provided.');
            }
        });
    }
}
