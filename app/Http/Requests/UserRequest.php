<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'role' => ['required', 'string'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'phone' => ['required', new Phone],
            'favoriteAffiliate' => ['nullable'],
            'worksInAffiliate' => ['nullable'],
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
            'role.required' => 'Выберите Роль пользователя',
            'name.required' => 'Заполните поле Имя',
            'phone.required' => 'Заполните поле Телефон',
        ];
    }
}
