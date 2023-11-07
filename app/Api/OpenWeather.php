<?php

declare(strict_types=1);

namespace App\Api;

use App\Models\Weather;
use App\Models\WeatherCollection;
use GuzzleHttp\Client;

class OpenWeather
{
    private Client $client;
    private const API_URL = "http://api.openweathermap.org/data/2.5/weather";

    public function __construct()
    {
        $this->client = new Client(); // TODO
    }

    private function getUrl(string $city): string
    {
        $params = [
            'q' => ucfirst($city),
            'units' => 'metric',
            'appid' => $_ENV['OPEN_WEATHER_API_KEY']
        ];
        return self::API_URL . '?' . http_build_query($params); //todo
    }

    public function fetchWeather(string $city): WeatherCollection
    {
        $weatherCollection = new WeatherCollection();

        $url = $this->getUrl($city);
        $response = $this->client->get($url);
        $data = json_decode($response->getBody()->getContents(), true);
        // var_dump($data);
        if ($data === null || !isset($data['code']) || $data['code'] !== 200) {
            //todo handle api errors or invalide input here, for now return epmty collection
        }

        $weather = new Weather(
            $data['name'],
            $data['sys']['country'],
            $data['timezone'],
            $data['weather'][0]['main'],
            $data['weather'][0]['description'],
            $data['main']['temp'],
            $data['main']['temp_min'],
            $data['main']['temp_max'],
            $data['main']['humidity'],
            $data['main']['pressure'],
            $data['wind']['speed'],
            $data['wind']['deg'],
        );
        $weatherCollection->add($weather);
        return $weatherCollection;
    }
}

