<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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
            'name'=>'required',
            'code'=>'required',
            'symbol'=>'required',
            'normal_val'=>'required',
            'us_value'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Currency name field is required',
            'code.required'=>'Code is required',
            'symbol.required'=>'Symbol field is required',
            'normal_val.required'=>'Currency value according to RWF field is required',
            'us_value.required'=>'Currency value according to US $ field is required',
        ];
    }
}


