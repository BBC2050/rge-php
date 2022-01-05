<?php

namespace BBC2050\Rge;

use BBC2050\Rge\Model\Entreprise;

interface EntrepriseInterface
{
    /**
     * Retourne la liste des entreprises RGE couvrant le domaine de travaux renseigné
     * 
     * @param string Domaine RGE
     * @param string Code INSEE de la commune
     * @param int Rayon (km)
     * 
     * @return array|Entreprise[]
     */
    public static function findBy(string $domaine, string $codeCommune, int $rayon): array;

    /**
     * Retourne l'entreprise RGE correspondant au SIRET renseigné
     * 
     * @param string SIRET de l'entreprise
     * @param \DateTimeInterface Date de vérification
     * 
     * @return null|Entreprise
     */
    public static function findOne(string $siret, \DateTimeInterface $date): null|Entreprise;
}
