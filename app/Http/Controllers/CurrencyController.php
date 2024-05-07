<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencySaveRequest;
use App\Models\Currency;
use App\Services\CurrencyServices;
use App\Services\ErrorService;
use Illuminate\Http\Request;

class CurrencyController extends Controller{
    public function list(CurrencyServices $currencyServices)
    {
        //$currencyServices->insertNewCurrecies();
        return view(
            'List',
            ['currencies' => $currencyServices->getall()]
        );
    }
    public function get(CurrencyServices $currencyServices, string $code)
    {
        return view('Get',
            ['currency' =>  $currencyServices->getbycode($code)]);
    }
    public function save(CurrencySaveRequest $request, CurrencyServices $currencyServices, ?Currency $currency=null)
    {
        $currencyServices->save(
            $currency,
            $request->post('code'),
            $request->post('name'),
            $request->post('value'));
        return response()->redirectToRoute('currencyList');
    }
    public function saveForm(ErrorService $errorService)
    {
        return view('FormSave',
        [
            'errorsValidate' => $errorService ->getErrors(['code','name','value'])
        ]);
    }
    public function FormEdit(Currency $currency)
    {
        return view('FormEdit',
            ['currency' =>  $currency]
    );
    }
}
