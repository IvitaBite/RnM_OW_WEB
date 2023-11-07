<?php

declare(strict_types=1);

namespace App\Models;

class WeatherCollection
{
    private array $weathers;

    public function __construct(array $weathers = [])
    {
        $this->weathers = $weathers;
        foreach ($weathers as $weather) {
            $this->add($weather);
        }
    }

    public function getWeathers(): array
    {
        return $this->weathers;
    }

    public function add(Weather $weather)
    {
        $this->weathers [] = $weather;
    }
}
