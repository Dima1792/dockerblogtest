<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Closure;

class CurrencySaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'max:10', 'min:3'],
            'name' => ['required', 'max:150', 'min:3'],
            'value' => [
                'required',
                'max:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    $valueNew = str_replace(',','.',$value);
                        if (!is_numeric($valueNew)){
                            $fail("Поле {$attribute} невалидное, должно быть число");
                    }
                },
            ],
        ];
    }
}
