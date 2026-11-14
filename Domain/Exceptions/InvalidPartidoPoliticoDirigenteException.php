<?php

declare(strict_types=1);

final class InvalidPartidoPoliticoDirigenteException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(string $cargo): self
    {
        return new self('The political party ' . $cargo . ' must not be empty.');
    }

    public static function becauseLengthIsTooShort(string $cargo, int $minLength): self
    {
        return new self('The political party ' . $cargo . ' must contain at least ' . $minLength . ' characters.');
    }

    public static function becauseLengthIsTooLong(string $cargo, int $maxLength): self
    {
        return new self('The political party ' . $cargo . ' must contain at most ' . $maxLength . ' characters.');
    }
}
