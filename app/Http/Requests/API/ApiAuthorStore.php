<?php

namespace App\Http\Requests\API;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;


class ApiAuthorStore extends FormRequest
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
            'name' => 'required|unique:authors|min:5',
            'user_id' => 'required'
        ];
    }

    public function failedValidation(Validator $validator)
    {
      $response = new Response(['error' => $validator->errors()] , 422);
      throw new ValidationException($validator , $response);
    }
}
