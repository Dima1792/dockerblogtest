<?php

namespace App\Services;

use App\DTO\CurrencyCBR\ItemDTO;
use App\Exceptions\ExceptionNotRegCurrency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
class CurrencyService extends Service
{
    const VALUTS = ['USD', 'EUR', 'GBP','BYN',];
    protected function getItemDTO():ItemDTO
    {
        return new ItemDTO();
    }
    public function getCurrencies(string $currencies)
    {
        //$data = json_decode(($this->getData('currency.log',env('APY_Currency_CBR_BASA_URL'))),true);
       // if (date("Y-n-d") <> ( DB::table('cb_currensies')->first('date')->date)) {
            $clien = new Client();
            $request = $clien->sendAsync($this->getNewRequest('GET',env('APY_CURRENCY_CBR_BASE_URL')))->wait();
            $data = (json_decode((string)$request->getbody(),true));
            DB::table('cb_currensies')->truncate();
            echo 'База данных обнавлена';
            foreach ($data['Valute'] as $valute) {
                $val = DB::table('cb_currensies')->where('valute', '=', $valute['CharCode'])->first();
                if ($val === null) {
                    DB::table('cb_currensies')->insert([
                        'date' => date("Y-n-d"),
                        'valute' => $valute['CharCode'],
                        'name' => $valute['Name'],
                        'value' => $valute['Value'],
                        'previous' => $valute['Previous']
                    ]);
                }
            }
        //}

        $result = [];
        $item = $this->getItemDTO();
        $val= DB::table('cb_currensies')->where('valute','=',$currencies)->first();
        if ((!empty($currencies)) && (!$val)){
            throw new ExceptionNotRegCurrency('Криворукий пользователь не правильно ввел название валюты');
        } elseif (!empty($currencies) ) {
            $item->name = $val->valute.' - '.$val->name;
            $item->value = $val->value;
            $result[] = $item;
        }   else{
            foreach (static::VALUTS as $currency) {
                $val= DB::table('cb_currensies')->where('valute','=',$currency)->first();
                $item = $this->getItemDTO();
                $item->name = $val->valute.' - '.$val->name;
                $item->value = $val->value.' рублей';
                $result[] = $item;
            }
        }

        return $result;
    }
    public  function getStringFromResult(array $items)
    {
        $resultText=[];
        foreach ($items as $item){
            $resultText[$item->name]=$item->value;
        }

        return $resultText;
    }
}
