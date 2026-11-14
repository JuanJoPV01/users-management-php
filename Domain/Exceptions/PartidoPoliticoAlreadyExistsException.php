<?php

declare(strict_types=1);

final class PartidoPoliticoAlreadyExistsException extends DomainException
{
    public static function becauseNombreAlreadyExists(string $nombre): self
    {
        return new self('A political party named ' . $nombre . ' already exists.');
    }
}
