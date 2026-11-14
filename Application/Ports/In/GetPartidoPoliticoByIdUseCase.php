<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetPartidoPoliticoByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/PartidoPoliticoModel.php';

interface GetPartidoPoliticoByIdUseCase
{
    public function execute(GetPartidoPoliticoByIdQuery $query): PartidoPoliticoModel;
}
