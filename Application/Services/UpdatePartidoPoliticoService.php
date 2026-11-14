<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdatePartidoPoliticoUseCase.php';
require_once __DIR__ . '/../Ports/Out/UpdatePartidoPoliticoPort.php';
require_once __DIR__ . '/../Ports/Out/GetPartidoPoliticoByIdPort.php';
require_once __DIR__ . '/../Ports/Out/GetPartidoPoliticoByNombrePort.php';
require_once __DIR__ . '/Mappers/PartidoPoliticoApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/PartidoPoliticoAlreadyExistsException.php';
require_once __DIR__ . '/../../Domain/Exceptions/PartidoPoliticoNotFoundException.php';
require_once __DIR__ . '/../../Domain/ValueObjects/PartidoPoliticoId.php';
require_once __DIR__ . '/../../Domain/ValueObjects/PartidoPoliticoNombre.php';

final class UpdatePartidoPoliticoService implements UpdatePartidoPoliticoUseCase
{
    private UpdatePartidoPoliticoPort $updatePartidoPoliticoPort;
    private GetPartidoPoliticoByIdPort $getPartidoPoliticoByIdPort;
    private GetPartidoPoliticoByNombrePort $getPartidoPoliticoByNombrePort;

    public function __construct(
        UpdatePartidoPoliticoPort $updatePartidoPoliticoPort,
        GetPartidoPoliticoByIdPort $getPartidoPoliticoByIdPort,
        GetPartidoPoliticoByNombrePort $getPartidoPoliticoByNombrePort
    ) {
        $this->updatePartidoPoliticoPort = $updatePartidoPoliticoPort;
        $this->getPartidoPoliticoByIdPort = $getPartidoPoliticoByIdPort;
        $this->getPartidoPoliticoByNombrePort = $getPartidoPoliticoByNombrePort;
    }

    public function execute(UpdatePartidoPoliticoCommand $command): PartidoPoliticoModel
    {
        $id = new PartidoPoliticoId($command->getId());
        $currentPartido = $this->getPartidoPoliticoByIdPort->getById($id);

        if ($currentPartido === null) {
            throw PartidoPoliticoNotFoundException::becauseIdWasNotFound($id->value());
        }

        $nombre = new PartidoPoliticoNombre($command->getNombre());
        $partidoWithSameNombre = $this->getPartidoPoliticoByNombrePort->getByNombre($nombre);

        if ($partidoWithSameNombre !== null && !$partidoWithSameNombre->id()->equals($id)) {
            throw PartidoPoliticoAlreadyExistsException::becauseNombreAlreadyExists($nombre->value());
        }

        $partidoToUpdate = PartidoPoliticoApplicationMapper::fromUpdateCommandToModel($command);

        return $this->updatePartidoPoliticoPort->update($partidoToUpdate);
    }
}
