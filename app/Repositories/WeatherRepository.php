<?php

namespace App\Repositories;

use App\Models\Weather;

/**
 * @method Weather getByFieldName(string $fieldName, $fieldValue)
 */
class WeatherRepository extends Repository
{
       public function getModelClass():string
    {
        return Weather::class;
    }
    public function getByParam(string $city, ?string $nameColumnsDB=null)
    {
        if ($nameColumnsDB === null){
            $temp = $this->getBuilder()
                ->where(Weather::f_CITY , '=' , $city)
                ->first();
        }else{
            $temp = $this->getBuilder()->select($nameColumnsDB)
                ->where(Weather::f_CITY , '=' , $city)
                ->first();
        }

         return $temp->$nameColumnsDB;
    }
    public function cityIs(string $city):bool
    {
        return $this->hasData(Weather::f_CITY, $city);
    }


}
