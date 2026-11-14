<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/PartidoPoliticoWebMapper.php';

require_once __DIR__ . '/../../Ports/In/CreatePartidoPoliticoUseCase.php';
require_once __DIR__ . '/../../Ports/In/UpdatePartidoPoliticoUseCase.php';
require_once __DIR__ . '/../../Ports/In/GetPartidoPoliticoByIdUseCase.php';
require_once __DIR__ . '/../../Ports/In/GetAllPartidosPoliticosUseCase.php';
require_once __DIR__ . '/../../Ports/In/DeletePartidoPoliticoUseCase.php';

final class PartidoPoliticoController
{
    private CreatePartidoPoliticoUseCase $createPartidoPoliticoUseCase;
    private UpdatePartidoPoliticoUseCase $updatePartidoPoliticoUseCase;
    private GetPartidoPoliticoByIdUseCase $getPartidoPoliticoByIdUseCase;
    private GetAllPartidosPoliticosUseCase $getAllPartidosPoliticosUseCase;
    private DeletePartidoPoliticoUseCase $deletePartidoPoliticoUseCase;
    private PartidoPoliticoWebMapper $mapper;

    public function __construct(
        CreatePartidoPoliticoUseCase $createPartidoPoliticoUseCase,
        UpdatePartidoPoliticoUseCase $updatePartidoPoliticoUseCase,
        GetPartidoPoliticoByIdUseCase $getPartidoPoliticoByIdUseCase,
        GetAllPartidosPoliticosUseCase $getAllPartidosPoliticosUseCase,
        DeletePartidoPoliticoUseCase $deletePartidoPoliticoUseCase,
        PartidoPoliticoWebMapper $mapper
    ) {
        $this->createPartidoPoliticoUseCase = $createPartidoPoliticoUseCase;
        $this->updatePartidoPoliticoUseCase = $updatePartidoPoliticoUseCase;
        $this->getPartidoPoliticoByIdUseCase = $getPartidoPoliticoByIdUseCase;
        $this->getAllPartidosPoliticosUseCase = $getAllPartidosPoliticosUseCase;
        $this->deletePartidoPoliticoUseCase = $deletePartidoPoliticoUseCase;
        $this->mapper = $mapper;
    }

    public function index(): array
    {
        $query = new GetAllPartidosPoliticosQuery();
        $partidos = $this->getAllPartidosPoliticosUseCase->execute($query);

        return array(
            'pageTitle' => 'Lista de partidos políticos',
            'partidos' => $partidos->items(),
            'total' => $partidos->total(),
            'page' => $partidos->page(),
            'limit' => $partidos->limit(),
            'message' => Flash::message(),
            'success' => Flash::success(),
        );
    }

    public function show(string $id): array
    {
        $query = new GetPartidoPoliticoByIdQuery($id);
        $partido = $this->getPartidoPoliticoByIdUseCase->execute($query);

        return array(
            'pageTitle' => 'Detalle de partido político',
            'partido' => $this->mapper->fromPartidoPoliticoToResponse($partido),
            'message' => Flash::message(),
        );
    }

    public function create(): array
    {
        return array(
            'pageTitle' => 'Registrar partido político',
            'page' => Flash::message(),
            'success' => Flash::success(),
            'errors' => Flash::errors(),
            'old' => Flash::old(),
        );
    }

    public function store(array $formData): void
    {
        try {
            $request = array(
                'id' => $formData['id'] ?? '',
                'nombre' => $formData['nombre'] ?? '',
                'eslogan' => $formData['eslogan'] ?? '',
                'presidente' => $formData['presidente'] ?? '',
                'secretario' => $formData['secretario'] ?? '',
                'tesorero' => $formData['tesorero'] ?? '',
                'pais' => $formData['pais'] ?? '',
                'num_presidentes' => $formData['num_presidentes'] ?? 0,
                'num_gobernadores' => $formData['num_gobernadores'] ?? 0,
                'num_alcaldes' => $formData['num_alcaldes'] ?? 0,
                'num_concejales' => $formData['num_concejales'] ?? 0,
                'num_congresistas' => $formData['num_congresistas'] ?? 0,
            );

            $command = $this->mapper->fromCreateRequestToCommand($request);
            $partido = $this->createPartidoPoliticoUseCase->execute($command);

            Flash::setSuccess('Partido político registrado correctamente.');
            View::redirect('partidos.show', array('id' => $partido->id()->value()));
        } catch (PartidoPoliticoAlreadyExistsException $e) {
            Flash::setMessage($e->getMessage());
            Flash::setOld($formData);
            View::redirect('partidos.create');
        } catch (Throwable $e) {
            Flash::setMessage('Error al registrar el partido político: ' . $e->getMessage());
            Flash::setOld($formData);
            View::redirect('partidos.create');
        }
    }

    public function edit(string $id): array
    {
        $query = new GetPartidoPoliticoByIdQuery($id);
        $partido = $this->getPartidoPoliticoByIdUseCase->execute($query);

        return array(
            'pageTitle' => 'Editar partido político',
            'partido' => $this->mapper->fromPartidoPoliticoToResponse($partido),
            'message' => Flash::message(),
            'errors' => Flash::errors(),
            'old' => Flash::old(),
        );
    }

    public function update(array $formData): void
    {
        try {
            $command = $this->mapper->fromUpdateCommandToRequest($formData);
            $partido = $this->updatePartidoPoliticoUseCase->execute($command);

            Flash::setSuccess('Partido político actualizado correctamente.');
            View::redirect('partidos.show', array('id' => $partido->id()->value()));
        } catch (PartidoPoliticoAlreadyExistsException $e) {
            Flash::setMessage($e->getMessage());
            View::redirect('partidos.edit', array('id' => $formData['id'] ?? ''));
        } catch (PartidoPoliticoNotFoundException $e) {
            Flash::setMessage($e->getMessage());
            View::redirect('partidos.index');
        } catch (Throwable $e) {
            Flash::setMessage('Error al actualizar el partido político: ' . $e->getMessage());
            View::redirect('partidos.edit', array('id' => $formData['id'] ?? ''));
        }
    }

    public function delete(string $id): void
    {
        try {
            $command = new DeletePartidoPoliticoCommand($id);
            $this->deletePartidoPoliticoUseCase->execute($command);

            Flash::setSuccess('Partido político eliminado correctamente.');
            View::redirect('partidos.index');
        } catch (PartidoPoliticoNotFoundException $e) {
            Flash::setMessage($e->getMessage());
            View::redirect('partidos.index');
        } catch (Throwable $e) {
            Flash::setMessage('Error al eliminar el partido político: ' . $e->getMessage());
            View::redirect('partidos.index');
        }
    }
}