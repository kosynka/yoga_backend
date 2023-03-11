<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class CreateLessonRequest extends FormRequest
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
            'type_id' => ['required', 'integer', 'exists:types,id'],
            'starts_at' => ['required', 'date_format:Y-m-d H:i'],
            'continuance' => ['required', 'integer', 'min:1'],
            'participants_limitation' => ['required', 'integer', 'min:1'],
            'comment' => ['nullable', 'string'],
        ];
    }
}
