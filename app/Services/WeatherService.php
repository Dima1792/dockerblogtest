<?php

namespace App\Services;

use App\DTO\WeatherDTO\ItemDTO;
use App\Exceptions\WeatherExceptionNotSpecifiedCity;
use App\Exceptions\WetherExceptionsNotFoutCity;
use App\Models\Weather;
use App\Repositories\WeatherRepository;
use App\Repositories\GuideCityRepository;

class WeatherService extends Service
{
    const PARAMS = ['hourly'=>'weatherParamsHourly', 'current'=>'weatherParamsCurrent', 'daily'=>'weatherParamsDaily'];
    public function __construct(protected WeatherRepository $weatherRepository,protected GuideCityRepository $guideCity)
    {

    }
    public function getListFromViews():array
    {
        return array_keys(static::PARAMS);
    }
    protected function getItemDTO(): ItemDTO
    {
        return new ItemDTO();
    }
    public function getListParams(ItemDTO $DTO, string $nameArray, string $nameParam):string
    {
        $temp = array_keys($DTO->$nameArray['unit']);
        array_shift($temp);

        return '&'.$nameParam.'='. implode(',' , $temp);
    }
    protected function getUrlForApi(string $city, ItemDTO $itemDTO):string
    {
            return sprintf(/*Basa URL*/ "%s" . /*Координаты города*/ "%s" . /*Params Current*/ "%s".
                /*Params Hourly*/ "%s" . /*Params Daily*/ "%s". /*Time zone*/ "%s",
                env('APY_WEATHER_BASE_URL'),
                $this->guideCity->getСoordinates($city),
                $this->getListParams($itemDTO,'weatherParamsCurrent',Weather::f_CURRENT),
                $this->getListParams($itemDTO,'weatherParamsHourly',Weather::f_HOURLY),
                $this->getListParams($itemDTO,'weatherParamsDaily',Weather::f_DAILY),
                $this->guideCity->getTimeZone($city)
            );
    }
    public function getParam( string $city, string $nameColumnsDB):array
    {
        return  json_decode($this->weatherRepository->getByParam($city,$nameColumnsDB),true);
    }
    protected function relevantDataForCityInDB(string $city):bool
    {
        return ((!$this->weatherRepository->cityIs($city)) ||
            ($this->weatherRepository->getByParam($city,Weather::f_DATE) <> date("Y-n-d"))) ;
    }
    public function saveWeatherInDB(string $city,$data):void
    {
        $this->weatherRepository->inserOrUpdateNoteDB([Weather::f_CITY => $city],
            ['date' => date("Y-n-d"),
            'current_units' => json_encode($data['current_units'],true),
            'current' => json_encode($data['current']),
            'hourly_units' => json_encode($data['hourly_units'],true),
            'hourly' => json_encode($data['hourly']),
            'daily_units' => json_encode($data['daily_units']),
            'daily' => json_encode($data['daily'])
        ]);
    }
    public function listCity()
    {
        return $this->guideCity->getCityList();
    }
    public function getWeatherFormAPI(string $city,string $param)
    {
        if (empty($city)) {
            throw new WeatherExceptionNotSpecifiedCity('Криворукий пользователь не ввел название города');
        }
        if (empty($this->guideCity->hasCity($city))) {
            throw new WetherExceptionsNotFoutCity('Криворукий пользователь не правильно ввел название города');
        }
        $item = $this->getItemDTO();
        if ($this->relevantDataForCityInDB($city)){
            $data = json_decode($this->getDataFormAPI( 'GET', $this->getUrlForApi($city, $item)),true);
            $this->saveWeatherInDB($city,$data);
        }
        $weather = $this->weatherRepository->getByFieldName(Weather::f_CITY, $city);

        $item->weatherParamsHourly['hourly'] =  json_decode($weather->hourly, true);
        $item->weatherParamsHourly['unit'] =  json_decode($weather->hourly_units, true) ;
        $item->weatherParamsCurrent['current'] = json_decode($weather->current, true);
        $item->weatherParamsCurrent['unit'] = json_decode($weather->current_units, true);
        $item->weatherParamsDaily['daily'] = json_decode($weather->daily, true);
        $item->weatherParamsDaily['unit'] = json_decode($weather->daily_units, true);
        return $item;
    }
    public function getResultFromDB(string $city, string $time, string $key) : array
    {
        $items = $this->getWeatherFormAPI($city, $key);
        $namePool= static::PARAMS[$key];
        $count = 0;
        $resultText[$count] = 'Погода для города ' . $city;
        foreach ($items->$namePool[$key] as $param => $value) {
            $count++;
            $resultText[$count] = $items->$namePool['name'][$param];
            if ($key == Weather::f_CURRENT) {
                $resultText[$count] .= " = {$items->$namePool[$key][$param]} ";
            }
            else{
                $resultText[$count] .= " = {$items->$namePool[$key][$param][$time]} ";
            }
            $resultText[$count] .= $items->$namePool['unit'][$param];
        }

        return $resultText;
    }
}
