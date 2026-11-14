<?php

declare(strict_types=1);

final class PartidoPoliticoNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound(string $id): self
    {
        return new self('The political party with id ' . $id . ' was not found.');
    }
}
