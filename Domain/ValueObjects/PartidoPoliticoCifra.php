<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidPartidoPoliticoCifraException.php';

final class PartidoPoliticoCifra
{
    private const MAX_VALUE = 10000000;

    private int $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw InvalidPartidoPoliticoCifraException::becauseValueIsNegative($value);
        }

        if ($value > self::MAX_VALUE) {
            throw InvalidPartidoPoliticoCifraException::becauseValueIsTooLarge($value, self::MAX_VALUE);
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value();
    }
}
