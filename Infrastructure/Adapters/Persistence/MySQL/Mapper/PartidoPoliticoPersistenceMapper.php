<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/PartidoPoliticoPersistenceDto.php';
require_once __DIR__ . '/../Entity/PartidoPoliticoEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/PartidoPoliticoModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PartidoPoliticoId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PartidoPoliticoNombre.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PartidoPoliticoEslogan.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PartidoPoliticoDirigente.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PartidoPoliticoPais.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PartidoPoliticoCifra.php';

final class PartidoPoliticoPersistenceMapper
{
    public function fromModelToDto(PartidoPoliticoModel $partidoPolitico): PartidoPoliticoPersistenceDto
    {
        return new PartidoPoliticoPersistenceDto(
            $partidoPolitico->id()->value(),
            $partidoPolitico->nombre()->value(),
            $partidoPolitico->eslogan()->value(),
            $partidoPolitico->presidente()->value(),
            $partidoPolitico->secretario()->value(),
            $partidoPolitico->tesorero()->value(),
            $partidoPolitico->pais()->value(),
            $partidoPolitico->numPresidentes(),
            $partidoPolitico->numGobernadores(),
            $partidoPolitico->numAlcaldes(),
            $partidoPolitico->numConcejales(),
            $partidoPolitico->numCongresistas()
        );
    }

    public function fromRowToEntity(array $row): PartidoPoliticoEntity
    {
        return new PartidoPoliticoEntity(
            (string) $row['id'],
            (string) $row['nombre'],
            (string) $row['eslogan'],
            (string) $row['presidente'],
            (string) $row['secretario'],
            (string) $row['tesorero'],
            (string) $row['pais'],
            (int) $row['num_presidentes'],
            (int) $row['num_gobernadores'],
            (int) $row['num_alcaldes'],
            (int) $row['num_concejales'],
            (int) $row['num_congresistas'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(PartidoPoliticoEntity $entity): PartidoPoliticoModel
    {
        return new PartidoPoliticoModel(
            new PartidoPoliticoId($entity->id()),
            new PartidoPoliticoNombre($entity->nombre()),
            new PartidoPoliticoEslogan($entity->eslogan()),
            new PartidoPoliticoDirigente($entity->presidente(), 'presidente'),
            new PartidoPoliticoDirigente($entity->secretario(), 'secretario'),
            new PartidoPoliticoDirigente($entity->tesorero(), 'tesorero'),
            new PartidoPoliticoPais($entity->pais()),
            new PartidoPoliticoCifra($entity->numPresidentes()),
            new PartidoPoliticoCifra($entity->numGobernadores()),
            new PartidoPoliticoCifra($entity->numAlcaldes()),
            new PartidoPoliticoCifra($entity->numConcejales()),
            new PartidoPoliticoCifra($entity->numCongresistas())
        );
    }

    public function fromRowToModel(array $row): PartidoPoliticoModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    public function fromRowsToModels(array $rows): array
    {
        $models = array();

        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }

        return $models;
    }
}
