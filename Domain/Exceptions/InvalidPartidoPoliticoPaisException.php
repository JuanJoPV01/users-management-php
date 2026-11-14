<?php

declare(strict_types=1);

final class InvalidPartidoPoliticoPaisException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The political party country must not be empty.');
    }

    public static function becauseLengthIsTooShort(int $minLength): self
    {
        return new self('The political party country must contain at least ' . $minLength . ' characters.');
    }

    public static function becauseLengthIsTooLong(int $maxLength): self
    {
        return new self('The political party country must contain at most ' . $maxLength . ' characters.');
    }
}
