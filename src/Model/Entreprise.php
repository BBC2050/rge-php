<?php

namespace BBC2050\Rge\Model;

class Entreprise
{
    public null|string $siret;
    public null|string $raisonSociale;
    public null|string $adresse;
    public null|string $codePostal;
    public null|string $commune;
    public null|string|float $latitude;
    public null|string|float $longitude;
    public null|string|float $distance;
    public null|string $telephone;
    public null|string $email;
    public null|array $qualifications;
    public null|array $domaines;

    public static function fromData(
        null|string $siret,
        null|string $raisonSociale,
        null|string $adresse,
        null|string $codePostal,
        null|string $commune,
        null|string|float $latitude,
        null|string|float $longitude,
        null|string|float $distance,
        null|string $telephone,
        null|string $email
    ): self
    {
        $entreprise = new Self();
        $entreprise->siret = $siret;
        $entreprise->raisonSociale = $raisonSociale;
        $entreprise->adresse = $adresse;
        $entreprise->codePostal = $codePostal;
        $entreprise->commune = $commune;
        $entreprise->latitude = (float) $latitude;
        $entreprise->longitude = (float) $longitude;
        $entreprise->distance = (float) $distance;
        $entreprise->telephone = \str_replace([' ', '.', '-'], '', $telephone);
        $entreprise->email = $email;

        return $entreprise;
    }
}
