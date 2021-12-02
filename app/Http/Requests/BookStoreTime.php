<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookStoreTime extends FormRequest
{
    public function messages()
    {
        return [
            'end_time.after' => 'The end time must be a time after start time.'
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
            'start_time' => 'required|date_format:H:i',
            'end_time' => ['required',
           ' date_format:H:i',
            'after:start_time'
//                Rule::unique('book_week_days')->where(function($query){
//                    return $query->where('week_day_id' , request('name'));
//                })
            ]
        ];
    }
}
