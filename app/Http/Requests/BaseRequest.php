<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        $errorMessages = $validator->errors()->all();

        if (!empty($errorMessages)) {
            $response['errors'] =  $errorMessages;
        }

        throw new ValidationException($validator, $response);
    }
}
