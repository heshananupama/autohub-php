<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpareDataRequest extends FormRequest
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

        'spareImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'partNumber' => 'required|max:100',
            'quantity'=>'integer|min:0',
            'cost'=>'integer|min:0',
            'price'=>'integer|min:0',


        ];
    }
}
