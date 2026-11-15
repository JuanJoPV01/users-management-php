<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/PartidoPoliticoWebMapper.php';

require_once __DIR__ . '/../../../../Application/Ports/In/CreatePartidoPoliticoUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdatePartidoPoliticoUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetPartidoPoliticoByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllPartidosPoliticosUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeletePartidoPoliticoUseCase.php';

require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllPartidosPoliticosQuery.php';
require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetPartidoPoliticoByIdQuery.php';
require_once __DIR__ . '/../../../../Application/Services/Dto/Commands/DeletePartidoPoliticoCommand.php';

require_once __DIR__ . '/../../../../Domain/Exceptions/PartidoPoliticoAlreadyExistsException.php';
require_once __DIR__ . '/../../../../Domain/Exceptions/PartidoPoliticoNotFoundException.php';

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

        $items = array();
        foreach ($partidos->items() as $item) {
            $items[] = $this->mapper->fromPartidoPoliticoToResponse($item);
        }

        return array(
            'pageTitle' => 'Lista de partidos políticos',
            'partidos' => $items,
            'total' => $partidos->total(),
            'page' => $partidos->page(),
            'limit' => $partidos->limit(),
            'message' => Flash::message(),
            'success' => Flash::success(),
        );
    }

    public function show(string $id): array
    {
        try {
            $query = new GetPartidoPoliticoByIdQuery($id);
            $partido = $this->getPartidoPoliticoByIdUseCase->execute($query);

            return array(
                'pageTitle' => 'Detalle de partido político',
                'partido' => $this->mapper->fromPartidoPoliticoToResponse($partido),
                'message' => Flash::message(),
            );
        } catch (PartidoPoliticoNotFoundException $e) {
            Flash::setMessage($e->getMessage());
            View::redirect('partidos.index');
            exit;
        }
    }

    public function create(): array
    {
        return array(
            'pageTitle' => 'Registrar partido político',
            'message' => Flash::message(),
            'success' => Flash::success(),
            'errors' => Flash::errors(),
            'old' => Flash::old(),
        );
    }

    public function store(array $formData): void
    {
        try {
            $command = $this->mapper->fromCreateRequestToCommand($formData);
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
        try {
            $query = new GetPartidoPoliticoByIdQuery($id);
            $partido = $this->getPartidoPoliticoByIdUseCase->execute($query);

            return array(
                'pageTitle' => 'Editar partido político',
                'partido' => $this->mapper->fromPartidoPoliticoToResponse($partido),
                'message' => Flash::message(),
                'errors' => Flash::errors(),
                'old' => Flash::old(),
            );
        } catch (PartidoPoliticoNotFoundException $e) {
            Flash::setMessage($e->getMessage());
            View::redirect('partidos.index');
            exit;
        }
    }

    public function update(array $formData): void
    {
        try {
            $command = $this->mapper->fromUpdateRequestToCommand($formData);
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