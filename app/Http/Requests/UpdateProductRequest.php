<?php

namespace App\Http\Requests;

use App\Enums\Product\StatusEnum;
use App\Enums\Product\TypeEnum;
use Illuminate\Validation\Rules\Enum;

class UpdateProductRequest extends BaseRequest
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
            'name' => 'sometimes|max:100',
            'price' => 'sometimes|regex:/^\d+(\.\d{1,2})?$/',
            'status' => ['sometimes', new Enum(StatusEnum::class)],
            'type' => ['sometimes', new Enum(TypeEnum::class)],
        ];
    }
}
