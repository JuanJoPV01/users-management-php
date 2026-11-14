<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../Models/PartidoPoliticoModel.php';

final class PartidoPoliticoUpdatedDomainEvent extends DomainEvent
{
    private PartidoPoliticoModel $partidoPolitico;

    public function __construct(PartidoPoliticoModel $partidoPolitico)
    {
        parent::__construct('partido_politico.updated');
        $this->partidoPolitico = $partidoPolitico;
    }

    public function partidoPolitico(): PartidoPoliticoModel
    {
        return $this->partidoPolitico;
    }

    public function payload(): array
    {
        return $this->partidoPolitico->toArray();
    }
}
