<?php

require __DIR__ . '/../vendor/autoload.php';

use BBC2050\Rge\Domaine;
use BBC2050\Rge\Entreprise;

var_dump(Domaine::findBy());
var_dump(Domaine::findOne('85'));
var_dump(Entreprise::findBy('85', "84092", 100));
var_dump(Entreprise::findOne('428075055000151', new \DateTime()));
