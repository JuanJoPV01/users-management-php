<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidPartidoPoliticoIdException.php';

final class PartidoPoliticoId
{
    private string $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim($value);

        if ($normalizedValue === '') {
            throw InvalidPartidoPoliticoIdException::becauseValueIsEmpty();
        }

        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i', $normalizedValue)) {
            throw InvalidPartidoPoliticoIdException::becauseFormatIsInvalid($normalizedValue);
        }

        $this->value = strtolower($normalizedValue);
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
