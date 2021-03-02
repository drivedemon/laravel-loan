<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLoanRequest extends FormRequest
{
    /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
    public function authorize(): bool
    {
        return true;
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules(): array
    {
        return [
            'amount' => 'required|between:1000,100000000|numeric',
            'term' => 'required|between:1,50|numeric',
            'rate' => 'required|between:1.00,36.00|numeric',
            'start_month' => 'required|between:1,12|numeric',
            'start_year' => 'required|between:2017,2050|numeric',
        ];
    }
}
