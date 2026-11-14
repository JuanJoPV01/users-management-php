<?php

declare(strict_types=1);

final class InvalidPartidoPoliticoEsloganException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The political party slogan must not be empty.');
    }

    public static function becauseLengthIsTooShort(int $minLength): self
    {
        return new self('The political party slogan must contain at least ' . $minLength . ' characters.');
    }

    public static function becauseLengthIsTooLong(int $maxLength): self
    {
        return new self('The political party slogan must contain at most ' . $maxLength . ' characters.');
    }
}
