<?php

namespace App\Http\Requests;

use App\Enums\Product\StatusEnum;
use App\Enums\Product\TypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateProductRequest extends BaseRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'status' => ['sometimes', new Enum(StatusEnum::class)],
            'type' => ['sometimes', new Enum(TypeEnum::class)],
            'user_id' => 'required|exists:users,id'
        ];
    }
}
