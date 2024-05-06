<?php

namespace App\DTO\WeatherDTO;

class ItemDTO
{
    public $weatherParamsHourly = [ "hourly" => [
                                        "time"=> '',
                                        "temperature_2m" => 0,
                                        "relative_humidity_2m" => 0,
                                        "precipitation"=>0,
                                        "surface_pressure" =>0,
                                        "cloud_cover" => 0,
                                        "wind_speed_10m" => 0
                                    ],
                                    "unit" => [
                                        "time"=> '',
                                        "temperature_2m" => '',
                                        "relative_humidity_2m" => '',
                                        "precipitation"=>'',
                                        "surface_pressure" =>'',
                                        "cloud_cover" => '',
                                        "wind_speed_10m" => ''
                                    ],
                                    "name" => [
                                        "time"=> " на ",
                                        "temperature_2m" => "Температура ",
                                        "relative_humidity_2m" => "Влажность ",
                                        "precipitation"=>'Вероятность осадков ',
                                        "surface_pressure"=>'Давление ',
                                        "cloud_cover" => "Облачность ",
                                        "wind_speed_10m" => "Ветер в приземном слое "
                                    ]];
    public $weatherParamsCurrent = [    "current" =>   [
                                            "time"=> '',
                                            "interval" => 0,
                                            "temperature_2m"=> 0,
                                            "relative_humidity_2m" => 0,
                                            "precipitation" => 0,
                                            "cloud_cover" => 0,
                                            "surface_pressure" => 0,
                                            "wind_speed_10m" => 0
                                        ],
                                        "unit" =>   [
                                            "time"=> '',
                                            "temperature_2m"=> 0,
                                            "relative_humidity_2m" => 0,
                                            "precipitation" => 0,
                                            "cloud_cover" => 0,
                                            "surface_pressure" => 0,
                                            "wind_speed_10m" => 0,
                                        ],
                                        "name" => [
                                            "time"=> " на ",
                                            "interval" => "Обнавление каждые ",
                                            "temperature_2m" => "Температура ",
                                            "relative_humidity_2m" => "Влажность ",
                                            "precipitation" => "Осадки ",
                                            "cloud_cover" => "Облачность ",
                                            "surface_pressure" => "Давление ",
                                            "wind_speed_10m" => "Ветер в приземном слое "
                                        ]
                                    ];
    public $weatherParamsDaily = [    "daily" =>   [
                                            "time"=> '',
                                            "temperature_2m_max" => 0,
                                            "temperature_2m_min" => 0,
                                            "daylight_duration" => 0,
                                            "precipitation_sum" => 0,
                                            "wind_gusts_10m_max" => 0
                                    ],
                                        "unit" =>   [
                                            "time"=> '',
                                            "temperature_2m_max" => '',
                                            "temperature_2m_min" => '',
                                            "daylight_duration" => '',
                                            "precipitation_sum" => '',
                                            "wind_gusts_10m_max" => ''
                                        ],
                                        "name" => [
                                            "time"=> " на ",
                                            "temperature_2m_max" => "Максимальная температура ",
                                            "temperature_2m_min" => "Минимальная температура ",
                                            "daylight_duration" => "Продолжительность дня ",
                                            "precipitation_sum" => "Колличество осадков ",
                                            "wind_gusts_10m_max" => "Максимамальный ветер в приземном слое "
                                        ]
                                    ];
}
