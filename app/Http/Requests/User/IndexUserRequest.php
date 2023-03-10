<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\UserRole;

class IndexUserRequest extends FormRequest
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
            'type' => ['nullable', new Enum(UserRole::class)],

            'page' => ['nullable', 'integer', 'min:1'],
            'limit' => ['nullable', 'integer', 'min:1'],
            'sortBy' => ['nullable', 'string'],
            'descending' => ['nullable', 'boolean'],
            'affiliate_id' => ['nullable', 'integer', 'exists:affiliates,id'],
            'city_id' => ['nullable', 'integer', 'exists:cities,id'],
        ];
    }
}
