<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/PartidoPoliticoId.php';

interface DeletePartidoPoliticoPort
{
    public function delete(PartidoPoliticoId $id): void;
}
