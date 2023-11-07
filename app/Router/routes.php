<?php

return [
    ['GET', '/', ['App\Controllers\SeasonController', 'index']],
    ['POST', '/', ['App\Controllers\WeatherController', 'search']],
    ['GET', '/season/{id}', ['App\Controllers\SeasonController', 'show']],
    ['GET', '/episode/{id}', ['App\Controllers\EpisodeController', 'show']],
    ['GET', '/search', ['App\Controllers\EpisodeController', 'search']],
];