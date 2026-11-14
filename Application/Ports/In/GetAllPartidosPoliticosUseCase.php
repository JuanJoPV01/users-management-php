<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllPartidosPoliticosQuery.php';
require_once __DIR__ . '/../../Services/Responses/PartidoPoliticoPage.php';

interface GetAllPartidosPoliticosUseCase
{
    public function execute(GetAllPartidosPoliticosQuery $query): PartidoPoliticoPage;
}
