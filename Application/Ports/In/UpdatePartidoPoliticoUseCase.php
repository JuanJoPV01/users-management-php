<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdatePartidoPoliticoCommand.php';
require_once __DIR__ . '/../../../Domain/Models/PartidoPoliticoModel.php';

interface UpdatePartidoPoliticoUseCase
{
    public function execute(UpdatePartidoPoliticoCommand $command): PartidoPoliticoModel;
}
