<?php

namespace App\Services;
use Illuminate\Support\MessageBag;

class ErrorService
{
    public function getErrors(array $fields)
    {
        $messageBag = $this->getMessageBag();
        if (empty($messageBag)){
           return [];
        }
        $result = [];
        foreach ($fields as $field){
            $errors = $messageBag->get($field);
            if (empty($errors)){
                continue;
            }
            $result[$field] = implode(' ',$errors);
        }
        return $result;
    }
    protected function getMessageBag()
    {
        /**@var MessageBag $massegeBag */
        $massegeBag =session()->get('errors');
        if (empty($massegeBag)){
            return null;
        }

        return $massegeBag;
    }
}
