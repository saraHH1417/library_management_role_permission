<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreBook extends FormRequest
{

//    public function __construct()
//    {
//        dd(request('author_id'));
//    }

    public function messages()
    {
        return [
            'publisher_id.unique' => 'This book already exists; please change Name, Publisher or Author'
        ];
    }
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
            'name' => 'required',
            'author_id'=> 'required',
            'publisher_id'=> ['required',
                Rule::unique('books')->where(function($query){
                   return $query->where('name' , request('name'))
                       ->where('author_id' , request('author_id'))
                       ->where('publisher_id' , request('publisher_id'));
                })
                ],
            'quantity' => 'required'
        ];
    }


}
