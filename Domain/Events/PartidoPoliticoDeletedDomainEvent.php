<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../ValueObjects/PartidoPoliticoId.php';

final class PartidoPoliticoDeletedDomainEvent extends DomainEvent
{
    private PartidoPoliticoId $partidoPoliticoId;

    public function __construct(PartidoPoliticoId $partidoPoliticoId)
    {
        parent::__construct('partido_politico.deleted');
        $this->partidoPoliticoId = $partidoPoliticoId;
    }

    public function partidoPoliticoId(): PartidoPoliticoId
    {
        return $this->partidoPoliticoId;
    }

    public function payload(): array
    {
        return array(
            'id' => $this->partidoPoliticoId->value(),
        );
    }
}
