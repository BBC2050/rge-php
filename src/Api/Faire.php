<?php

namespace BBC2050\Rge\Api;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;
use BBC2050\Rge\Exception\BadRequestException;
use BBC2050\Rge\Exception\ServiceUnavailableException;

class Faire
{
    public const BASE_URL = 'https://france-renov.gouv.fr/fr/api/rge';

    /**
     * @param string Identifiant SIRET de l'entreprise
     * @param \DateTimeInterface Date de vérification
     * 
     * @return array
     * 
     * @throws ServiceUnavailableException
     * @throws BadRequestException
     */
    public static function company(string $siret, \DateTimeInterface $date): array
    {
        $client = HttpClient::create();

        /** @var ResponseInterface */
        $response = $client->request('POST', self::BASE_URL . '/company', [
            'json' => [
                'siret' => $siret,
                'date' => $date->format('d/m/Y')
            ]
        ]);

        if ($response->getStatusCode() === 503) {
            throw new ServiceUnavailableException('Service indisponible');
        }
        if ($response->getStatusCode() !== 200) {
            throw new BadRequestException($response->getContent());
        }
        return $response->toArray()['Company'] ?? [];
    }

    /**
     * @param string
     * @param string
     * @param string
     * 
     * @return array
     * 
     * @throws ServiceUnavailableException
     * @throws BadRequestException
     */
    public static function companies(string $domaine, string $codeCommune, int $rayon): array
    {
        $client = HttpClient::create();

        /** @var ResponseInterface */
        $response = $client->request('POST', self::BASE_URL . '/companies', [
            'json' => [
                'domaine' => $domaine,
                'insee' => $codeCommune,
                'rayon' => $rayon
            ]
        ]);

        if ($response->getStatusCode() === 503) {
            throw new ServiceUnavailableException('Service indisponible');
        }
        if ($response->getStatusCode() !== 200) {
            throw new BadRequestException($response->getContent());
        }
        return $response->toArray()['Companies'] ?? [];
    }

}
