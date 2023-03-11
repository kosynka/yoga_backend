<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLessonRequest extends FormRequest
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
            'type_id' => ['nullable', 'integer', 'exists:types,id'],
            'starts_at' => ['nullable', 'date_format:Y-m-d H:i'],
            'continuance' => ['nullable', 'integer', 'min:1'],
            'participants_limitation' => ['nullable', 'integer', 'min:1'],
            'comment' => ['nullable', 'string'],
        ];
    }
}
