<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Api\RickAndMorty;
use App\Response;

class SeasonController
{
    private RickAndMorty $api;

    public function __construct()
    {
        $this->api = new RickAndMorty();
    }

    public function index(): Response
    {
        return new Response('home', [
            'seasons' => $this->api->fetchSeasons()
        ]);
    }

    public function show(array $vars): Response
    {
        $seasonId = (int)$vars['id'];

        return new Response('season', [
            'seasonId' => $seasonId,
            'episodes' => $this->api->fetchEpisodesBySeasonId($seasonId)
        ]);
    }

}