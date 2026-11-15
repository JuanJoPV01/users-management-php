<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SavePartidoPoliticoPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdatePartidoPoliticoPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetPartidoPoliticoByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetPartidoPoliticoByNombrePort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllPartidosPoliticosPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/CountPartidosPoliticosPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeletePartidoPoliticoPort.php';

require_once __DIR__ . '/../Mapper/PartidoPoliticoPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/PartidoPoliticoModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PartidoPoliticoId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/PartidoPoliticoNombre.php';

final class PartidoPoliticoRepositoryMySQL implements
    SavePartidoPoliticoPort,
    UpdatePartidoPoliticoPort,
    GetPartidoPoliticoByIdPort,
    GetPartidoPoliticoByNombrePort,
    GetAllPartidosPoliticosPort,
    CountPartidosPoliticosPort,
    DeletePartidoPoliticoPort
{
    private PDO $pdo;
    private PartidoPoliticoPersistenceMapper $mapper;

    public function __construct(PDO $pdo, PartidoPoliticoPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(PartidoPoliticoModel $partidoPolitico): PartidoPoliticoModel
    {
        $dto = $this->mapper->fromModelToDto($partidoPolitico);

        $sql = '
            INSERT INTO partidos_politicos (
                id,
                nombre,
                eslogan,
                presidente,
                secretario,
                tesorero,
                pais,
                num_presidentes,
                num_gobernadores,
                num_alcaldes,
                num_concejales,
                num_congresistas,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :nombre,
                :eslogan,
                :presidente,
                :secretario,
                :tesorero,
                :pais,
                :num_presidentes,
                :num_gobernadores,
                :num_alcaldes,
                :num_concejales,
                :num_congresistas,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $dto->id(),
            ':nombre' => $dto->nombre(),
            ':eslogan' => $dto->eslogan(),
            ':presidente' => $dto->presidente(),
            ':secretario' => $dto->secretario(),
            ':tesorero' => $dto->tesorero(),
            ':pais' => $dto->pais(),
            ':num_presidentes' => $dto->numPresidentes(),
            ':num_gobernadores' => $dto->numGobernadores(),
            ':num_alcaldes' => $dto->numAlcaldes(),
            ':num_concejales' => $dto->numConcejales(),
            ':num_congresistas' => $dto->numCongresistas(),
        ));

        $savedPartido = $this->getById(new PartidoPoliticoId($dto->id()));

        if ($savedPartido === null) {
            throw new RuntimeException('The political party could not be recovered after save.');
        }

        return $savedPartido;
    }

    public function update(PartidoPoliticoModel $partidoPolitico): PartidoPoliticoModel
    {
        $dto = $this->mapper->fromModelToDto($partidoPolitico);

        $sql = '
            UPDATE partidos_politicos
               SET nombre = :nombre,
                   eslogan = :eslogan,
                   presidente = :presidente,
                   secretario = :secretario,
                   tesorero = :tesorero,
                   pais = :pais,
                   num_presidentes = :num_presidentes,
                   num_gobernadores = :num_gobernadores,
                   num_alcaldes = :num_alcaldes,
                   num_concejales = :num_concejales,
                   num_congresistas = :num_congresistas,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $dto->id(),
            ':nombre' => $dto->nombre(),
            ':eslogan' => $dto->eslogan(),
            ':presidente' => $dto->presidente(),
            ':secretario' => $dto->secretario(),
            ':tesorero' => $dto->tesorero(),
            ':pais' => $dto->pais(),
            ':num_presidentes' => $dto->numPresidentes(),
            ':num_gobernadores' => $dto->numGobernadores(),
            ':num_alcaldes' => $dto->numAlcaldes(),
            ':num_concejales' => $dto->numConcejales(),
            ':num_congresistas' => $dto->numCongresistas(),
        ));

        $updatedPartido = $this->getById(new PartidoPoliticoId($dto->id()));

        if ($updatedPartido === null) {
            throw new RuntimeException('The political party could not be recovered after update.');
        }

        return $updatedPartido;
    }

    public function getById(PartidoPoliticoId $id): ?PartidoPoliticoModel
    {
        $sql = '
            SELECT
                id,
                nombre,
                eslogan,
                presidente,
                secretario,
                tesorero,
                pais,
                num_presidentes,
                num_gobernadores,
                num_alcaldes,
                num_concejales,
                num_congresistas,
                created_at,
                updated_at
            FROM partidos_politicos
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':id' => $id->value()));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    public function getByNombre(PartidoPoliticoNombre $nombre): ?PartidoPoliticoModel
    {
        $sql = '
            SELECT
                id,
                nombre,
                eslogan,
                presidente,
                secretario,
                tesorero,
                pais,
                num_presidentes,
                num_gobernadores,
                num_alcaldes,
                num_concejales,
                num_congresistas,
                created_at,
                updated_at
            FROM partidos_politicos
            WHERE LOWER(nombre) = LOWER(:nombre)
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':nombre' => $nombre->value()));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    public function getAll(string $search, int $limit, int $offset): array
    {
        $sql = '
            SELECT
                id,
                nombre,
                eslogan,
                presidente,
                secretario,
                tesorero,
                pais,
                num_presidentes,
                num_gobernadores,
                num_alcaldes,
                num_concejales,
                num_congresistas,
                created_at,
                updated_at
            FROM partidos_politicos
            WHERE (:search = \'\' OR nombre ILIKE :pattern_nombre OR pais ILIKE :pattern_pais)
            ORDER BY nombre ASC
            LIMIT :limit OFFSET :offset
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':search', $search);
        $statement->bindValue(':pattern_nombre', '%' . $search . '%');
        $statement->bindValue(':pattern_pais', '%' . $search . '%');
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();

        return $this->mapper->fromRowsToModels($statement->fetchAll());
    }

    public function count(string $search): int
    {
        $sql = '
            SELECT COUNT(*) AS total
            FROM partidos_politicos
            WHERE (:search = \'\' OR nombre ILIKE :pattern_nombre OR pais ILIKE :pattern_pais)
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':search', $search);
        $statement->bindValue(':pattern_nombre', '%' . $search . '%');
        $statement->bindValue(':pattern_pais', '%' . $search . '%');
        $statement->execute();

        return (int) $statement->fetchColumn();
    }

    public function delete(PartidoPoliticoId $id): void
    {
        $sql = 'DELETE FROM partidos_politicos WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(':id' => $id->value()));
    }
}
