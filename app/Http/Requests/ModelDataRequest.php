<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelDataRequest extends FormRequest
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
            'modelName' => 'required|max:50',
            'country' => 'required|alpha',
            'year' => 'required|date_format:"Y"',
            'engineCapacity'=>'regex:/\d{3,4}[c]{2}/',
            'fuelType'=>'required',
            'transmissionType'=>'required',
            'brandName'=>'required'



        ];
    }
}
