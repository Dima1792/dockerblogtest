<?php

namespace App\Services;

use App\Models\Currency;

class CurrencyServices
{
    public function save(?Currency $currency, string $code, string $name, string $value)
    {
        if (empty($currency)) {
            $currency =new Currency();
        }
        $currency->code = $code;
        $currency->name = $name;
        $currency->value = $value;
        $currency->save();
        return response()->redirectToRoute('currencyList');
    }
    public function getbycode(string $code)
    {
       return  Currency::query()
                ->where('code', '=', $code)
                ->first();
    }
    public function getall()
    {
        return Currency::query()->get();
    }
    public function getEdit(string $id)
    {
        return  Currency::query()
            ->where('id', '=', $id)
            ->first();
    }
}
