<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeletePartidoPoliticoUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeletePartidoPoliticoPort.php';
require_once __DIR__ . '/../Ports/Out/GetPartidoPoliticoByIdPort.php';
require_once __DIR__ . '/Mappers/PartidoPoliticoApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/PartidoPoliticoNotFoundException.php';

final class DeletePartidoPoliticoService implements DeletePartidoPoliticoUseCase
{
    private DeletePartidoPoliticoPort $deletePartidoPoliticoPort;
    private GetPartidoPoliticoByIdPort $getPartidoPoliticoByIdPort;

    public function __construct(
        DeletePartidoPoliticoPort $deletePartidoPoliticoPort,
        GetPartidoPoliticoByIdPort $getPartidoPoliticoByIdPort
    ) {
        $this->deletePartidoPoliticoPort = $deletePartidoPoliticoPort;
        $this->getPartidoPoliticoByIdPort = $getPartidoPoliticoByIdPort;
    }

    public function execute(DeletePartidoPoliticoCommand $command): void
    {
        $id = PartidoPoliticoApplicationMapper::fromDeleteCommandToId($command);
        $partidoPolitico = $this->getPartidoPoliticoByIdPort->getById($id);

        if ($partidoPolitico === null) {
            throw PartidoPoliticoNotFoundException::becauseIdWasNotFound($id->value());
        }

        $this->deletePartidoPoliticoPort->delete($id);
    }
}
