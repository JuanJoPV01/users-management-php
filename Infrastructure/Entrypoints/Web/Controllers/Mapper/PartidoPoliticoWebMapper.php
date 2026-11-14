<?php

declare(strict_types=1);

require_once __DIR__ . '/Ports/In/CreatePartidoPoliticoUseCase.php';
require_once __DIR__ . '/Ports/In/UpdatePartidoPoliticoUseCase.php';
require_once __DIR__ . '/Ports/In/GetPartidoPoliticoByIdUseCase.php';
require_once __DIR__ . '/Ports/In/GetAllPartidosPoliticosUseCase.php';
require_once __DIR__ . '/Ports/In/DeletePartidoPoliticoUseCase.php';

require_once __DIR__ . '/Mappers/UserWebMapper.php';

require_once __DIR__ . '/../../Domain/Models/UserModel.php';

final class PartidoPoliticoWebMapper
{
    public function fromPartidoPoliticoToResponse(PartidoPoliticoModel $partidoPolitico): array
    {
        return array(
            'id' => $partidoPolitico->id()->value(),
            'nombre' => $partidoPolitico->nombre()->value(),
            'eslogan' => $partidoPolitico->eslogan()->value(),
            'presidente' => $partidoPolitico->presidente()->value(),
            'secretario' => $partidoPolitico->secretario()->value(),
            'tesorero' => $partidoPolitico->tesorero()->value(),
            'pais' => $partidoPolitico->pais()->value(),
            'num_presidentes' => $partidoPolitico->numPresidentes(),
            'num_gobernadores' => $partidoPolitico->numGobernadores(),
            'num_alcaldes' => $partidoPolitico->numAlcaldes(),
            'num_concejales' => $partidoPolitico->numConcejales(),
            'num_congresistas' => $partidoPolitico->numCongresistas(),
        );
    }

    public function fromCreateRequestToCommand($request): CreatePartidoPoliticoCommand
    {
        return new CreatePartidoPoliticoCommand(
            $request['id'] ?? generateUuid4(),
            $request['nombre'],
            $request['eslogan'],
            $request['presidente'],
            $request['secretario'],
            $request['tesorero'],
            $request['pais'],
            $request['num_presidentes'] ?? 0,
            $request['num_gobernadores'] ?? 0,
            $request['num_alcaldes'] ?? 0,
            $request['num_concejales'] ?? 0,
            $request['num_congresistas'] ?? 0
        );
    }

    public function fromUpdateCommandToRequest(UpdatePartidoPoliticoCommand $command): array
    {
        return array(
            'id' => $command->getId(),
            'nombre' => $command->getNombre(),
            'eslogan' => $command->getEslogan(),
            'presidente' => $command->getPresidente(),
            'secretario' => $command->getSecretario(),
            'tesorero' => $command->getTesorero(),
            'pais' => $command->getPais(),
            'num_presidentes' => $command->getNumPresidentes(),
            'num_gobernadores' => $command->getNumGobernadores(),
            'num_alcaldes' => $command->getNumAlcaldes(),
            'num_concejales' => $command->getNumConcejales(),
            'num_congresistas' => $command->getNumCongresistas(),
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetPartidoPoliticoByIdQuery
    {
        return new GetPartidoPoliticoByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeletePartidoPoliticoCommand
    {
        return new DeletePartidoPoliticoCommand($id);
    }
}