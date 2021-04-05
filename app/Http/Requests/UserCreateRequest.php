<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'login'                 => 'required|string|unique:user,login',
            'password'              => 'required|string|min:8|max:30',
            'fio'                   => 'required|string',
            'email'                 => 'required|email|string',
            'number_phone'          => 'required|string|min:10'
        ];
    }

    public function messages()
    {
        return [
          'login.required'          => 'Поле "Логин" обязательно',
          'login.string'            => 'Поле "Логин" должно содержать только буквы и цифры',
          'login.unique:user,login' => 'Логин должен быть уникальным',

          'password.required'       => 'Поле "Пароль" обязательно',
          'password.string'         => 'Поле "Пароль" должно содержать только буквы и цифры',
          'password.min:8'          => 'Поле "Пароль" должно содержать не менее 8 символов',
          'password.max:30'         => 'Поле "Пароль" должно содержать не более 30 символов',

          'fio.required'            => 'Поле "ФИО пользователя" обязательно',
          'fio.sring'               => 'Поле "ФИО пользователя" должно содержать только буквы и цифры',

          'email.required'          => 'Поле "Email" обязательно',
          'email.email'             => 'Поле "Email" должно соответствовать своему типу',
          'email.string'            => 'Поле "Email" должно содержать только буквы и цифры',

          'number_phone.required'   => 'Поле "Номер телефона" обязательно',
          'number_phone.string'     => 'Поле "Номер телефона" должно содержать только буквы и цифры',
          'number_phone.min:10'     => 'Поле "Номер телефона" должно содержать не менее 10 символов',
        ];
    }
}
