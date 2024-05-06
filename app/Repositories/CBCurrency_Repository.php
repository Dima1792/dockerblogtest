<?php

namespace App\Repositories;

use App\Models\cbCurrency;

class CBCurrency_Repository extends Repository
{
    public function getModelClass():string
    {
        return cbCurrency::class;
    }
    public function getByNote(string $nameColumn, string $value)
    {
        return $this->getBuilder()->where($nameColumn, '=', $value)->first();
    }
    public function getcode(string $code)
    {
        return $this->getBuilder()->where(cbCurrency::f_VALUTE, '=', $code)->first();
    }
    public function gelListCodeCurrency()
    {
        return $this->getBuilder()->get([cbCurrency::f_NAME,cbCurrency::f_VALUTE]);
    }
    public function gelListCurrencies(array $valuts)
    {
        return $this->getBuilder()->whereIn(cbCurrency::f_VALUTE, $valuts)
            ->get([cbCurrency::f_VALUTE, cbCurrency::f_VALUE,cbCurrency::f_NAME]);
    }
    public function upsertCurrency(array $currency)
    {
        return $this->getBuilder()->upsert($currency, cbCurrency::f_VALUTE);
    }
}
