<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/PartidoPoliticoModel.php';

interface UpdatePartidoPoliticoPort
{
    public function update(PartidoPoliticoModel $partidoPolitico): PartidoPoliticoModel;
}
