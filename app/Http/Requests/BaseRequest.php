<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

abstract class BaseRequest extends FormRequest
{
    abstract public static function getFromFieldsName(): string;

    protected function failedValidation(Validator $validator)
    {
        $values = [];
        foreach (array_keys($this->rules()) as $field){
            if (!empty($this->post($field))){
                $values[$field] = $this->post($field);
            }}
        if (!empty($values)){
            $this->session()->put($this->getFromFieldsName(),$values);
        }
        parent::failedValidation($validator);
    }
}
