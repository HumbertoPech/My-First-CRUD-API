<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRules extends FormRequest
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
            'data.attributes.name' => 'required',
            'data.attributes.price' => 'bail|required|numeric|gt:0'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(){
        $prefix = 'data.attributes.';
        return [
            $prefix.'name.required' => 'The product name is neccesary',
            $prefix.'price.required' => 'The product price is neccesary',
            $prefix.'price.numeric' => 'The price should be numeric',
            $prefix.'price.gt' => 'The price must be greater than zero'
        ];
    }

    /**
     * Override the failedValidation() of Validator method to issue the exception with a diferent representation
     * 
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return \Illuminate\Http\Exceptions\HttpResponseException 
     */
    protected function failedValidation(Validator $validator){
        $response = ['errors' => []];
        $arrayTemp = [];
        foreach($validator->errors()->toArray() as $key => $value){
            //Form the array with a specify representation
            $arrayTemp = [
                'code' => 'ERROR-1',
                'source' => $key,
                'title' => 'Unprocessable Entity',
                'detail' => $value[0], //this will only show an error for an attribute, to show all the errors
                //that generated an attribute, it's necessary to do another foreach loop for the array ($item)
            ];
            array_push($response['errors'], $arrayTemp);
        }
        throw new HttpResponseException(response()->json($response,422));
    }

    public function attributes(){
        return [
            'data.attributes.name' => 'name',
            'data.attributes.price' => 'price'
        ];
    }
}
