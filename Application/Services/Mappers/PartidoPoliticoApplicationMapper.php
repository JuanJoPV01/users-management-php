<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreatePartidoPoliticoCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdatePartidoPoliticoCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeletePartidoPoliticoCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetPartidoPoliticoByIdQuery.php';

require_once __DIR__ . '/../../../Domain/Models/PartidoPoliticoModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PartidoPoliticoId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PartidoPoliticoNombre.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PartidoPoliticoEslogan.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PartidoPoliticoDirigente.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PartidoPoliticoPais.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/PartidoPoliticoCifra.php';

final class PartidoPoliticoApplicationMapper
{
    public static function fromCreateCommandToModel(
        CreatePartidoPoliticoCommand $command
    ): PartidoPoliticoModel {
        return PartidoPoliticoModel::create(
            new PartidoPoliticoId($command->getId()),
            new PartidoPoliticoNombre($command->getNombre()),
            new PartidoPoliticoEslogan($command->getEslogan()),
            new PartidoPoliticoDirigente($command->getPresidente(), 'presidente'),
            new PartidoPoliticoDirigente($command->getSecretario(), 'secretario'),
            new PartidoPoliticoDirigente($command->getTesorero(), 'tesorero'),
            new PartidoPoliticoPais($command->getPais()),
            new PartidoPoliticoCifra($command->getNumPresidentes()),
            new PartidoPoliticoCifra($command->getNumGobernadores()),
            new PartidoPoliticoCifra($command->getNumAlcaldes()),
            new PartidoPoliticoCifra($command->getNumConcejales()),
            new PartidoPoliticoCifra($command->getNumCongresistas())
        );
    }

    public static function fromUpdateCommandToModel(
        UpdatePartidoPoliticoCommand $command
    ): PartidoPoliticoModel {
        return new PartidoPoliticoModel(
            new PartidoPoliticoId($command->getId()),
            new PartidoPoliticoNombre($command->getNombre()),
            new PartidoPoliticoEslogan($command->getEslogan()),
            new PartidoPoliticoDirigente($command->getPresidente(), 'presidente'),
            new PartidoPoliticoDirigente($command->getSecretario(), 'secretario'),
            new PartidoPoliticoDirigente($command->getTesorero(), 'tesorero'),
            new PartidoPoliticoPais($command->getPais()),
            new PartidoPoliticoCifra($command->getNumPresidentes()),
            new PartidoPoliticoCifra($command->getNumGobernadores()),
            new PartidoPoliticoCifra($command->getNumAlcaldes()),
            new PartidoPoliticoCifra($command->getNumConcejales()),
            new PartidoPoliticoCifra($command->getNumCongresistas())
        );
    }

    public static function fromGetByIdQueryToId(GetPartidoPoliticoByIdQuery $query): PartidoPoliticoId
    {
        return new PartidoPoliticoId($query->getId());
    }

    public static function fromDeleteCommandToId(DeletePartidoPoliticoCommand $command): PartidoPoliticoId
    {
        return new PartidoPoliticoId($command->getId());
    }

    public static function fromModelToArray(PartidoPoliticoModel $partidoPolitico): array
    {
        return $partidoPolitico->toArray();
    }

    public static function fromModelsToArray(array $partidosPoliticos): array
    {
        $result = array();

        foreach ($partidosPoliticos as $partidoPolitico) {
            $result[] = self::fromModelToArray($partidoPolitico);
        }

        return $result;
    }
}
