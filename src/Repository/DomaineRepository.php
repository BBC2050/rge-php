<?php

namespace BBC2050\Rge\Repository;

class DomaineRepository
{
    /**
     * Retourne l'ensemble des domaines RGE
     * 
     * @return array
     */
    public static function findAll(): array
    {
        return \json_decode(file_get_contents(__DIR__ . '/../../' . '/core/database/' . 'domaine.json'), true);
    }

    /**
     * Retourne l'ensemble des domaines RGE par famille et/ou par statut
     * 
     * @param null|string Famille
     * @param null|string Statut
     * 
     * @return array
     */
    public static function findBy(null|string $famille = null, null|bool $actif = null): array
    {
        return \array_filter(self::findAll(), function($item) use ($famille, $actif) {
            return ($famille === null || $famille === $item['famille']) && ($actif === null || $actif === $item['actif']);
        });
    }

    /**
     * Retourne un domaine RGE actif
     * 
     * @param string Code du domaine RGE recherché
     * 
     * @return null|array
     */
    public static function findOne(string $code): null|array
    {
        $results = \array_filter(self::findAll(), function($item) use ($code) {
            return $item['code'] === $code && $item['actif'] === true;
        });

        return \count($results) > 0 ? \current($results) : null;
    }

}
