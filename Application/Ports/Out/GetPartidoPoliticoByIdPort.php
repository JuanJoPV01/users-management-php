<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/PartidoPoliticoModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PartidoPoliticoId.php';

interface GetPartidoPoliticoByIdPort
{
    public function getById(PartidoPoliticoId $id): ?PartidoPoliticoModel;
}
