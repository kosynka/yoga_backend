<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class AffiliateRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:1'],
            'phone' => ['required', new Phone],
            'description' => ['required', 'string', 'min:1'],
            'link' => ['nullable', 'string', 'min:1'],
            'image' => ['nullable', 'file'],
            'city' => ['required'],
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
            'name.required' => 'Заполните поле Название',
            'phone.required' => 'Заполните поле Телефон',
            'description.required' => 'Заполните поле Описание',
            'city.required' => 'Выберите Город',
        ];
    }
}
