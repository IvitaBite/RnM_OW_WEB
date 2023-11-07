<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Api\OpenWeather;
use Twig\Environment;

class WeatherController
{
    private OpenWeather $api;
    private Environment $twig;
    private string $defaultLocation;
    private string $searchLocation;

    public function __construct(Environment $twig)
    {
        $this->api = new OpenWeather();
        $this->twig = $twig;
        $this->defaultLocation = 'Riga';
        $this->searchLocation = $_POST['city'] ?? '';
    }

    public function search(): array
    {
        $defaultData = $this->api->fetchWeather($this->defaultLocation);


        $city = $this->searchLocation;
        $weatherData = null;
        $localTime = null;

        if ($city) {
            $weatherData = $this->api->fetchWeather($city);

            if ($weatherData->getWeathers()) {
                $localTime = $weatherData->getWeathers()[0]->getLocalTime();
            }
        }

        $this->twig->addGlobal('defaultData', $defaultData);
        $this->twig->addGlobal('weatherData', $weatherData);
        $this->twig->addGlobal('currentDatetime', $localTime);
        return [];
    }
}



