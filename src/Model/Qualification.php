<?php

namespace BBC2050\Rge\Model;

class Qualification
{
    public null|string $id;
    public null|string $nom;
    public null|string $url;
    public null|string $organisme;

    public static function fromData(
        null|string $id,
        null|string $nom,
        null|string $url,
        null|string $organisme
    ): self
    {
        $domaine = new Self();
        $domaine->id = $id;
        $domaine->nom = $nom;
        $domaine->url = $url;
        $domaine->organisme = $organisme;

        return $domaine;
    }
}
