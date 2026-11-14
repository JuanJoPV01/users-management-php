<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllPartidosPoliticosUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllPartidosPoliticosPort.php';
require_once __DIR__ . '/../Ports/Out/CountPartidosPoliticosPort.php';
require_once __DIR__ . '/Responses/PartidoPoliticoPage.php';

final class GetAllPartidosPoliticosService implements GetAllPartidosPoliticosUseCase
{
    private GetAllPartidosPoliticosPort $getAllPartidosPoliticosPort;
    private CountPartidosPoliticosPort $countPartidosPoliticosPort;

    public function __construct(
        GetAllPartidosPoliticosPort $getAllPartidosPoliticosPort,
        CountPartidosPoliticosPort $countPartidosPoliticosPort
    ) {
        $this->getAllPartidosPoliticosPort = $getAllPartidosPoliticosPort;
        $this->countPartidosPoliticosPort = $countPartidosPoliticosPort;
    }

    public function execute(GetAllPartidosPoliticosQuery $query): PartidoPoliticoPage
    {
        $items = $this->getAllPartidosPoliticosPort->getAll(
            $query->getSearch(),
            $query->getLimit(),
            $query->getOffset()
        );

        $total = $this->countPartidosPoliticosPort->count($query->getSearch());

        return new PartidoPoliticoPage(
            $items,
            $total,
            $query->getPage(),
            $query->getLimit()
        );
    }
}
