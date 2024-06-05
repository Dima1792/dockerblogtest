<?php

namespace App\Http\Controllers;

use App\Exceptions\WeatherExceptionNotSpecifiedCity;
use App\Exceptions\WetherExceptionsNotFoutCity;
use App\Services\WeatherService;
use \Illuminate\Http\Request;

class weatherController extends Controller
{
    public function getWeather(Request $request,WeatherService $weatherService , string $city, int $time=0)
    {
        $city = $request->get('cityGet', 'Петропавловск-Камчатский');
        $time = $request->get('timeGet',0);
        $param = $request->get('params', "hourly");
        try {
            $result= $weatherService->getResultFromDB($city, $time ,$param);
        } catch (WeatherExceptionNotSpecifiedCity  $exception) {
            $exception->recLog();
            $city = "Петропавловск-Камчатский";
            echo 'Значение города не введено, город по умолчанию Петропавловск-Камчатский';
            $result= $weatherService->getResultFromDB($city, $time,$param);
        }catch (WetherExceptionsNotFoutCity $exception){
            $city = "Москва";
            $exception->recLog();
            echo 'Значение города заданно не верно, выбран город по умолчанию Москва';
            $result= $weatherService->getResultFromDB($city, $time, $param);
        }catch (\Exception) {
            echo 'Не знаю что ты такое на тварил разбирайся сам';
            return view('404');
        }
        $listCity = $weatherService->listCity();
        $listParams = $weatherService->getListFromViews();
        return view('weather', compact('result','listParams','city','listCity'));
    }
    public function getWeatherJS(Request $request,WeatherService $weatherService)
    {
        $city = $request->get('cityGet', 'Петропавловск-Камчатский');
        $time = $request->get('timeGet',0);
        $param = $request->get('params', "hourly");
        $result= $weatherService->getResultFromDB($city, $time ,$param);
        $listCity = $weatherService->listCity();
        $listParams = $weatherService->getListFromViews();
        //sleep(7);
        return ['ListJS' => 'result','listParams','listCity'];
    }
}
