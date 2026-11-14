<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidPartidoPoliticoNombreException.php';

final class PartidoPoliticoNombre
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 120;

    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim($value);

        if ($normalizedValue === '') {
            throw InvalidPartidoPoliticoNombreException::becauseValueIsEmpty();
        }

        $length = mb_strlen($normalizedValue);

        if ($length < self::MIN_LENGTH) {
            throw InvalidPartidoPoliticoNombreException::becauseLengthIsTooShort(self::MIN_LENGTH);
        }

        if ($length > self::MAX_LENGTH) {
            throw InvalidPartidoPoliticoNombreException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
