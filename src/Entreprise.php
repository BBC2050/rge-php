<?php

namespace BBC2050\Rge;

use BBC2050\Rge\Model\Entreprise as Model;
use BBC2050\Rge\Api\Faire;
use BBC2050\Rge\Model\Domaine;
use BBC2050\Rge\Model\Qualification;
use BBC2050\Rge\Repository\DomaineRepository;

class Entreprise implements EntrepriseInterface
{
    /**
     * @inheritdoc
     */
    public static function findBy(string $domaine, string $codeCommune, int $rayon): array
    {
        return \array_map(function($item) {
            return self::dataTransformer($item);
        }, Faire::companies($domaine, $codeCommune, $rayon));
    }

    /**
     * @inheritdoc
     */
    public static function findOne(string $siret): null|Model
    {
        $response = Faire::company($siret);
        $response = \end($response);

        if (empty($response)) {
            return null;
        }

        return self::dataTransformer($response);
    }

    private static function dataTransformer(array $data): Model
    {
        $entreprise = Model::fromData(
            $data['SIRET'] ?? null,
            $data['name'] ?? null,
            $data['address'] && $data['address']['rue'] ?? null,
            $data['address'] && $data['address']['code postal'] ?? null,
            $data['address'] && $data['address']['ville'] ?? null,
            $data['latitude'] ?? null,
            $data['longitude'] ?? null,
            $data['distance'] ?? null,
            $data['phone'] ?? null,
            $data['email'] ?? null,
        );

        $entreprise->qualifications = \array_map(function($item) {
            return Qualification::fromData(
                $item['id'] ?? null,
                $item['name'] ?? null,
                $item['url'] ?? null,
                $item['name_certif'] ?? null
            );
        }, $data['qualifications'] ?? []);


        foreach ($data['domaines'] ?? [] as $item) {
            if (!$item['id']) {
                continue;
            }
            if (null !== $domaine = DomaineRepository::findOne($item['id'])) {
                $entreprise->domaines[] = Domaine::fromData(
                    $domaine['code'] ?? null,
                    $domaine['nom'] ?? null,
                    $domaine['famille'] ?? null,
                    $domaine['actif'] ?? null
                );
            }
        }
        return $entreprise;
    }
}
