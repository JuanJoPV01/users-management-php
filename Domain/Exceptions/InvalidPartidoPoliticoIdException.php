<?php

declare(strict_types=1);

final class InvalidPartidoPoliticoIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The political party id must not be empty.');
    }

    public static function becauseFormatIsInvalid(string $id): self
    {
        return new self('The political party id format is invalid: ' . $id);
    }
}
