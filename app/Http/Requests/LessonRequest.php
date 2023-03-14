<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => ['required'],
            'instructor' => ['required'],
            'starts_at' => ['required'],
            'continuance' => ['required', 'integer', 'min:1'],
            'participants_limitation' => ['required', 'integer', 'min:1'],
            'comment' => ['nullable', 'string', 'min:1'],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'type.required' => 'Выберите Тип урока',
            'instructor.required' => 'Выберите Инструктора',
            'starts_at.required' => 'Заполните поле Начало занятия',
            'continuance.required' => 'Заполните поле Продолжительности занятия',
            'participants_limitation.required' => 'Заполните поле Ограничения количества людей',
        ];
    }
}
