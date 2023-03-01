<?php

namespace App\Http\Requests\Assignment;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssignmentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'lesson_id' => ['required', 'integer', 'exists:lessons,id'],
            // 'type_id' => ['required', 'integer', 'exists:types'],
            // 'starts_at' => ['required', 'date_format:Y-m-d H:i'],
        ];
    }
}
