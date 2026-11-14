<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/PartidoPoliticoModel.php';

interface GetAllPartidosPoliticosPort
{
    public function getAll(string $search, int $limit, int $offset): array;
}
