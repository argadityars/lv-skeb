<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|alpha_spaces|max:255',
            'province_id' => 'required|numeric',
            'city_id' => 'required_with:province_id|numeric',
            'address' => 'required_with:city_id',
            'date' => 'required|numeric',
            'month' => 'required|numeric',
            'year' => 'required|numeric',
            'phone' => 'numeric'
        ];
    }
}
