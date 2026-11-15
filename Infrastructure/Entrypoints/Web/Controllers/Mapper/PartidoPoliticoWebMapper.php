<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreatePartidoPoliticoCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdatePartidoPoliticoCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeletePartidoPoliticoCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetPartidoPoliticoByIdQuery.php';

require_once __DIR__ . '/../../../../../Domain/Models/PartidoPoliticoModel.php';

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

    public function fromCreateRequestToCommand(array $request): CreatePartidoPoliticoCommand
    {
        $id = isset($request['id']) && trim((string) $request['id']) !== ''
            ? trim((string) $request['id'])
            : (function_exists('generateUuid4') ? generateUuid4() : uniqid('partido_', true));

        return new CreatePartidoPoliticoCommand(
            $id,
            (string) ($request['nombre'] ?? ''),
            (string) ($request['eslogan'] ?? ''),
            (string) ($request['presidente'] ?? ''),
            (string) ($request['secretario'] ?? ''),
            (string) ($request['tesorero'] ?? ''),
            (string) ($request['pais'] ?? ''),
            (int) ($request['num_presidentes'] ?? 0),
            (int) ($request['num_gobernadores'] ?? 0),
            (int) ($request['num_alcaldes'] ?? 0),
            (int) ($request['num_concejales'] ?? 0),
            (int) ($request['num_congresistas'] ?? 0)
        );
    }

    public function fromUpdateRequestToCommand(array $request): UpdatePartidoPoliticoCommand
    {
        return new UpdatePartidoPoliticoCommand(
            (string) ($request['id'] ?? ''),
            (string) ($request['nombre'] ?? ''),
            (string) ($request['eslogan'] ?? ''),
            (string) ($request['presidente'] ?? ''),
            (string) ($request['secretario'] ?? ''),
            (string) ($request['tesorero'] ?? ''),
            (string) ($request['pais'] ?? ''),
            (int) ($request['num_presidentes'] ?? 0),
            (int) ($request['num_gobernadores'] ?? 0),
            (int) ($request['num_alcaldes'] ?? 0),
            (int) ($request['num_concejales'] ?? 0),
            (int) ($request['num_congresistas'] ?? 0)
        );
    }

    public function fromUpdateCommandToRequest($input): UpdatePartidoPoliticoCommand
    {
        if (is_array($input)) {
            return $this->fromUpdateRequestToCommand($input);
        }
        if ($input instanceof UpdatePartidoPoliticoCommand) {
            return $input;
        }
        throw new InvalidArgumentException('Datos inválidos para actualizar partido político.');
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