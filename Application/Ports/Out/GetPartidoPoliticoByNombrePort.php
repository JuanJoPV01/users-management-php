<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/PartidoPoliticoModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PartidoPoliticoNombre.php';

interface GetPartidoPoliticoByNombrePort
{
    public function getByNombre(PartidoPoliticoNombre $nombre): ?PartidoPoliticoModel;
}
