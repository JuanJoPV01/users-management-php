<?php

declare(strict_types=1);

final class InvalidPartidoPoliticoCifraException extends InvalidArgumentException
{
    public static function becauseValueIsNegative(int $value): self
    {
        return new self('The political party count must not be negative: ' . $value);
    }

    public static function becauseValueIsTooLarge(int $value, int $maxValue): self
    {
        return new self('The political party count must not exceed ' . $maxValue . ': ' . $value);
    }
}
