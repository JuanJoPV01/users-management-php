<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreatePartidoPoliticoCommand.php';
require_once __DIR__ . '/../../../Domain/Models/PartidoPoliticoModel.php';

interface CreatePartidoPoliticoUseCase
{
    public function execute(CreatePartidoPoliticoCommand $command): PartidoPoliticoModel;
}
