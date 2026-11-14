<?php

declare(strict_types=1);

interface CountPartidosPoliticosPort
{
    public function count(string $search): int;
}
