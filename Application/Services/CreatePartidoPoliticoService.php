<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreatePartidoPoliticoUseCase.php';
require_once __DIR__ . '/../Ports/Out/SavePartidoPoliticoPort.php';
require_once __DIR__ . '/../Ports/Out/GetPartidoPoliticoByNombrePort.php';
require_once __DIR__ . '/Mappers/PartidoPoliticoApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/PartidoPoliticoAlreadyExistsException.php';
require_once __DIR__ . '/../../Domain/ValueObjects/PartidoPoliticoNombre.php';

final class CreatePartidoPoliticoService implements CreatePartidoPoliticoUseCase
{
    private SavePartidoPoliticoPort $savePartidoPoliticoPort;
    private GetPartidoPoliticoByNombrePort $getPartidoPoliticoByNombrePort;

    public function __construct(
        SavePartidoPoliticoPort $savePartidoPoliticoPort,
        GetPartidoPoliticoByNombrePort $getPartidoPoliticoByNombrePort
    ) {
        $this->savePartidoPoliticoPort = $savePartidoPoliticoPort;
        $this->getPartidoPoliticoByNombrePort = $getPartidoPoliticoByNombrePort;
    }

    public function execute(CreatePartidoPoliticoCommand $command): PartidoPoliticoModel
    {
        $nombre = new PartidoPoliticoNombre($command->getNombre());
        $existingPartido = $this->getPartidoPoliticoByNombrePort->getByNombre($nombre);

        if ($existingPartido !== null) {
            throw PartidoPoliticoAlreadyExistsException::becauseNombreAlreadyExists($nombre->value());
        }

        $partidoPolitico = PartidoPoliticoApplicationMapper::fromCreateCommandToModel($command);

        return $this->savePartidoPoliticoPort->save($partidoPolitico);
    }
}
