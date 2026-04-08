<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StartFocusSessionRequest extends FormRequest
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
            'task_id' => ['required', 'integer', 'exists:tasks,id'],
            'step_id' => ['required', 'integer', 'exists:task_steps,id'],
            'duration_minutes' => ['sometimes', 'integer', 'min:5', 'max:120'],
            'session_notes' => ['sometimes', 'nullable', 'string', 'max:500'],
        ];
    }
}
