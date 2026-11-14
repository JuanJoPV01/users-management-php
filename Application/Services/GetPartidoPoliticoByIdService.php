<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetPartidoPoliticoByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetPartidoPoliticoByIdPort.php';
require_once __DIR__ . '/Mappers/PartidoPoliticoApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/PartidoPoliticoNotFoundException.php';

final class GetPartidoPoliticoByIdService implements GetPartidoPoliticoByIdUseCase
{
    private GetPartidoPoliticoByIdPort $getPartidoPoliticoByIdPort;

    public function __construct(GetPartidoPoliticoByIdPort $getPartidoPoliticoByIdPort)
    {
        $this->getPartidoPoliticoByIdPort = $getPartidoPoliticoByIdPort;
    }

    public function execute(GetPartidoPoliticoByIdQuery $query): PartidoPoliticoModel
    {
        $id = PartidoPoliticoApplicationMapper::fromGetByIdQueryToId($query);
        $partidoPolitico = $this->getPartidoPoliticoByIdPort->getById($id);

        if ($partidoPolitico === null) {
            throw PartidoPoliticoNotFoundException::becauseIdWasNotFound($id->value());
        }

        return $partidoPolitico;
    }
}
