<?php

namespace BBC2050\Rge;

use BBC2050\Rge\Model\Domaine;

interface DomaineInterface
{
    /**
     * Retourne la liste des domaines RGE
     * 
     * @param string Famille RGE
     * @param bool Statut du domaine
     * 
     * @return array|Domaine[]
     */
    public static function findBy(null|string $famille = null, null|bool $statut = null): array;

    /**
     * Retourne le domaine RGE correspondant au code renseigné
     * 
     * @param string Code du domaine
     * 
     * @return null|Domaine
     */
    public static function findOne(string $code): null|Domaine;
}
