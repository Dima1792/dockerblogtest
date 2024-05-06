<?php

namespace App\Services;

use App\DTO\CurrencyCBR\ItemDTO;
use App\Exceptions\ExceptionNotRegCurrency;
use App\Models\cbCurrency;
use App\Repositories\CBCurrency_Repository;

class CurrencyService extends Service
{
    const VALUTS = ['USD', 'EUR', 'GBP', 'BYN',];
    public function __construct(protected CBCurrency_Repository $cbCurrency_Repository)
    {

    }

    protected function getItemDTO(): ItemDTO
    {
        return new ItemDTO();
    }

    public function getcode($name): string
    {
        return $this->cbCurrency_Repository-> cbCurrency::query()->where('name', '=', $name)
            ->get('valute')
            ->value('valute');
    }

    public function updateCurrenciesIfNeed()
    {
        if (!$this->getCurrencyByDate()) {
            $this->updateCurrecies();
        }
    }

    public function getCurrency(string $code)
    {
        if (strlen($code) > 3) {
            return $this->cbCurrency_Repository->getByNote(cbCurrency::f_NAME, $code);
        }
        return $this->cbCurrency_Repository->getByNote(cbCurrency::f_VALUTE, $code);
    }

    public function getListCurrency()
    {
        return $this->cbCurrency_Repository->gelListCodeCurrency();
    }

    public function getCurrencies(string $currencyCode)
    {

        if (!empty($currencyCode)) {
            $currencyModel = $this->getCurrency($currencyCode);
            if (!$currencyModel) {
                throw new ExceptionNotRegCurrency('Криворукий пользователь не правильно ввел название валюты');
            }
            $item = $this->getItemDTO();
            $item->name = $currencyModel->valute . ' - ' . $currencyModel->name;
            $item->value = $currencyModel->value;
            return [$item];
        }

        $result = [];
        foreach ($this->getCurrencyListDefault() as $currency) {
            $item = $this->getItemDTO();
            $item->name = $currency->valute . ' - ' . $currency->name;
            $item->value = $currency->value . ' рублей';
            $result[] = $item;
        }
        return $result;
    }

    public function getStringFromResult(array $items)
    {
        $resultText = [];
        foreach ($items as $item) {
            $resultText[$item->name] = $item->value;
        }

        return $resultText;
    }

    protected function getCurrencyByDate()
    {
        return $this->cbCurrency_Repository->getByNote('date', date("Y-n-d"));
    }

    protected function updateCurrecies()
    {
        $data = json_decode($this->getDataFormAPI('GET', env('APY_CURRENCY_CBR_BASE_URL')), true);
        $values = [];
        foreach ($data['Valute'] as $valute) {
            $values[] = [
                'date' => date("Y-n-d"),
                'valute' => $valute['CharCode'],
                'name' => $valute['Name'],
                'value' => $valute['Value'],
                'previous' => $valute['Previous']
            ];
        }
        $this->cbCurrency_Repository->upsertCurrency($values);
    }

    protected function getCurrencyListDefault()
    {
        return $this->cbCurrency_Repository->gelListCurrencies(static::VALUTS);
    }
}
