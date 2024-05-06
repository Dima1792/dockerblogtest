<?php

namespace App\Repositories;

use App\Models\GuideCity;

class GuideCityRepository extends Repository
{
    public function getModelClass():string
    {
        return GuideCity::class;
    }
    public function getСoordinates(string $city):string
    {
       $rezult = $this->getBuilder()
           ->select('latitude', 'longitude')
           ->where('city', '=', $city)
           ->get()[0];
        return '?latitude='.$rezult['latitude'].'&longitude='.$rezult['longitude'];
    }
    public function getTimeZone(string $city):string
    {
        return $this->getBuilder()
            ->select(GuideCity::f_TIMEZONE)
            ->where(GuideCity::f_CITY, '=', $city)
            ->get()[0][GuideCity::f_TIMEZONE];
    }
    public function hasCity(string $city):bool
    {
        return $this->hasData(GuideCity::f_CITY, $city);
    }
    public function getCityList()
    {
        return $this->getBuilder()->pluck(GuideCity::f_CITY);
    }

}
