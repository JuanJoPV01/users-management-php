<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidPartidoPoliticoPaisException.php';

final class PartidoPoliticoPais
{
    private const MIN_LENGTH = 2;
    private const MAX_LENGTH = 80;

    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim($value);

        if ($normalizedValue === '') {
            throw InvalidPartidoPoliticoPaisException::becauseValueIsEmpty();
        }

        $length = mb_strlen($normalizedValue);

        if ($length < self::MIN_LENGTH) {
            throw InvalidPartidoPoliticoPaisException::becauseLengthIsTooShort(self::MIN_LENGTH);
        }

        if ($length > self::MAX_LENGTH) {
            throw InvalidPartidoPoliticoPaisException::becauseLengthIsTooLong(self::MAX_LENGTH);
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
