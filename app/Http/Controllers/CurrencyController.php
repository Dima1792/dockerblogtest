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
    public function saveForm(ErrorService $errorService, Request $request)
    {
        $fields = $request->session()->get(CurrencySaveRequest::getFromFieldsName());
        $request->session()->pull(CurrencySaveRequest::getFromFieldsName(),null);
        return view('FormSave',
        [
            'errorsValidate' => $errorService ->getErrors(['code','name','value']),
            'fields' => $fields
        ]);
    }
    public function FormEdit(ErrorService $errorService, Currency $currency, Request $request)
    {

        return view('FormEdit',
            [
                'currency' =>  $currency,
                'errorsValidate' => $errorService ->getErrors(['code','name','value'])
//                'code' => $request->get('code'),
//                'name' => $request->get('name'),
//                'value' => $request->post('value','')
            ]
        );
    }
}
