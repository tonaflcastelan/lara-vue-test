<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
            'name'      => 'required',
            'email'     => 'required|email',
            'role_id'   => 'required|not_in:0|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'El nombre del usuario es requerido',
            'email.required'    => 'El email requerido',
            'email.unique'      => 'Este email ya ha sido regisrado',
            'role_id.required'  => 'El rol es requerido',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->messages(), 422));
    }
}
