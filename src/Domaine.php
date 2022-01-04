<?php

namespace BBC2050\Rge;

use BBC2050\Rge\Model\Domaine as Model;
use BBC2050\Rge\Repository\DomaineRepository;

class Domaine implements DomaineInterface
{
    /**
     * @inheritdoc
     */
    public static function findBy(null|string $famille = null, null|bool $statut = null): array
    {
        return \array_map(function($item) {
            return Model::fromData($item['code'], $item['nom'], $item['famille'], $item['actif']);
        }, DomaineRepository::findBy($famille, $statut));
    }

    /**
     * @inheritdoc
     */
    public static function findOne(string $code): null|Model
    {
        if (null !== $result = DomaineRepository::findOne($code)) {
            return Model::fromData($result['code'], $result['nom'], $result['famille'], $result['actif']);
        }
        return null;
    }
}
