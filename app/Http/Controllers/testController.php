<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionNotRegCurrency;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class testController extends Controller
{
    public function testAction( Request $request, CurrencyService $currencyService,string $currency=null)
    {
        $currency ??= $request->post('currencyName', '');

        try {
            $currencyService->updateCurrenciesIfNeed();
            $result=$currencyService->getStringFromResult($currencyService->getCurrencies($currency));
            $list = $currencyService->getListCurrency();
            $item =$currency;
            return view('currency', compact('result','list','item'));

        } catch (ExceptionNotRegCurrency $exception){
            Log::error($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            abort(404);
            //return view('404');
        } catch (Throwable $exception){
            Log::error($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
            throw $exception;
        }
    }
}
