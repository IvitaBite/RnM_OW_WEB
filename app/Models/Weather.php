<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class Weather
{
    private string $city;
    private string $country;
    private int $timezone;
    private string $weather;
    private string $weatherDescription;
    private float $temperature;
    private float $temperatureMin;
    private float $temperatureMax;
    private float $pressure;
    private float $humidity;
    private float $windSpeed;
    private int $windDegrees;

    public function __construct(
        string $city,
        string $country,
        int    $timezone,
        string $weather,
        string $weatherDescription,
        float  $temperature,
        float  $temperatureMin,
        float  $temperatureMax,
        float  $pressure,
        float  $humidity,
        float  $windSpeed,
        int    $windDegrees
    )
    {
        $this->city = $city;
        $this->country = $country;
        $this->timezone = $timezone;
        $this->weather = $weather;
        $this->weatherDescription = $weatherDescription;
        $this->temperature = $temperature;
        $this->temperatureMin = $temperatureMin;
        $this->temperatureMax = $temperatureMax;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
        $this->windSpeed = $windSpeed;
        $this->windDegrees = $windDegrees;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getTimezone(): int
    {
        return $this->timezone;
    }

    public function getWeather(): string
    {
        return $this->weather;
    }

    public function getWeatherDescription(): string
    {
        return $this->weatherDescription;
    }

    public function getTemperature(): float
    {
        return round($this->temperature, 1);
    }

    public function getTemperatureMin(): float
    {
        return round($this->temperatureMin, 1);
    }

    public function getTemperatureMax(): float
    {
        return round($this->temperatureMax, 1);
    }

    public function getPressure(): float
    {
        return $this->pressure;
    }

    public function getHumidity(): float
    {
        return $this->humidity;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    public function getWindDegrees(): int
    {
        return $this->windDegrees;
    }

    function getWindDirection(): string
    {
        $directions = [
            'N', 'NNE', 'NE', 'ENE',
            'E', 'ESE', 'SE', 'SSE',
            'S', 'SSW', 'SW', 'WSW',
            'W', 'WNW', 'NW', 'NNW'
        ];
        $index = round(($this->getWindDegrees() % 360) / 22.5);
        return $directions[$index];
    }

    public function getLocalTime(): string
    {
        $utcTime = Carbon::now('UTC');
        $localTime = $utcTime->addSecond($this->timezone);

        return $localTime->format('D d-m-Y H:i');

    }
}
