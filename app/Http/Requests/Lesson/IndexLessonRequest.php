<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class IndexLessonRequest extends FormRequest
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
            'filter' => ['nullable', 'string'],
            'page' => ['nullable', 'integer', 'min:1'],
            'limit' => ['nullable', 'integer', 'min:1'],
            'sortBy' => ['nullable', 'string'],
            'descending' => ['nullable', 'boolean'],
            'starts_at' => ['nullable', 'date'],
            'type_id' => ['nullable', 'integer', 'exists:types,id'],
            'instructor_id' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
