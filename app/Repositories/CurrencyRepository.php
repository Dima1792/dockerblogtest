<?php

namespace App\Repositories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Model;

class CurrencyRepository extends Repository
{
      public function getModelClass():string
    {
        return Currency::class;
    }
    public function getbycode(string $code)
    {
        return $this->getBuilder()->where(Currency::f_CODE, '=', $code)->first();
    }
    public function getAll()
    {
        return $this->getBuilder()->get();
    }
}
