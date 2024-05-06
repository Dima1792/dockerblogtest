<?php

namespace App\Services;

use App\Models\Currency;
use App\Repositories\CurrencyRepository;

class CurrencyServices extends Service
{

    public function __construct(protected CurrencyRepository $currencyRepository)
    {

    }
    public function save(?Currency $currency, string $code, string $name, string $value)
    {
        $this->currencyRepository->inserOrUpdateNoteDB([Currency::f_CODE => $code], [Currency::f_VALUE => $value, Currency::f_NAME => $name]);
//        if (empty($currency)) {
//            $currency =$this->currencyRepository->getNewModel();
//        }
//        $currency->code = $code;
//        $currency->name = $name;
//        $currency->value = $value;
//        $this->currencyRepository->save($currency);
//        return response()->redirectToRoute('currencyList');
    }
    public function getbycode(string $code)
    {
       return  $this->currencyRepository->getbycode($code);
    }
    public function getall()
    {
        return $this->currencyRepository->getAll();
    }
    public function insertNewCurrecies()
    {
        $data = json_decode($this->getDataFormAPI('GET', env('APY_CURRENCY_CBR_BASE_URL')), true);
        $values = [];
        foreach ($data['Valute'] as $valute) {
            $values[] = [
                'code' => $valute['CharCode'],
                'value' => $valute['Value'],
                'name' => $valute['Name']
            ];
        }
        Currency::query()->upsert($values, 'valute');
    }
}
