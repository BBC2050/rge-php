<?php

namespace BBC2050\Rge\Model;

class Domaine
{
    public null|string $code;
    public null|string $nom;
    public null|string $famille;
    public null|bool $actif;

    public static function fromData(
        null|string $code,
        null|string $nom,
        null|string $famille,
        null|bool $actif
    ): self
    {
        $domaine = new Self();
        $domaine->code = $code;
        $domaine->nom = $nom;
        $domaine->famille = $famille;
        $domaine->actif = $actif;

        return $domaine;
    }
}
