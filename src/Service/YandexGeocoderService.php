<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class YandexGeocoderService
{
    private const YANDEX_GEOCODE_API_URL = 'https://geocode-maps.yandex.ru/v1/?apikey=%s&geocode=%s&format=json';

    public function __construct(
        private readonly string $apiKey,
        private readonly HttpClientInterface $client,
    ) {
    }

    public function getCoordinatesByAddress(string $address): mixed
    {
        $response = $this->client->request(Request::METHOD_GET, sprintf(
            self::YANDEX_GEOCODE_API_URL,
            $this->apiKey,
            $address,
        ));

        $content = $response->getContent();
        $statusCode = $response->getStatusCode();

        if ($statusCode !== Response::HTTP_OK) {
            return null;
        }

        $content = json_decode($content, true);

        $coordinates = explode(' ', $content['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']);

        return [
            'longitude' => $coordinates[0],
            'latitude' => $coordinates[1],
        ];
    }
}
