<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRetailerDataRequest extends FormRequest
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
        return  [
            'name' => 'required|max:255',
            'shopName' => 'required|max:255',
            'address' => 'required|max:255',
            'contactNo' => 'min:10|numeric',
            'retailerImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'email' => 'required|email|max:255|unique:users',
         ];
    }
}
