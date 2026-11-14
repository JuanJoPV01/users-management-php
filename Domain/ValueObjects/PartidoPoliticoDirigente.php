<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidPartidoPoliticoDirigenteException.php';

final class PartidoPoliticoDirigente
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 100;

    private string $value;
    private string $cargo;

    public function __construct(string $value, string $cargo)
    {
        $normalizedValue = trim($value);
        $normalizedCargo = trim($cargo);

        if ($normalizedValue === '') {
            throw InvalidPartidoPoliticoDirigenteException::becauseValueIsEmpty($normalizedCargo);
        }

        $length = mb_strlen($normalizedValue);

        if ($length < self::MIN_LENGTH) {
            throw InvalidPartidoPoliticoDirigenteException::becauseLengthIsTooShort($normalizedCargo, self::MIN_LENGTH);
        }

        if ($length > self::MAX_LENGTH) {
            throw InvalidPartidoPoliticoDirigenteException::becauseLengthIsTooLong($normalizedCargo, self::MAX_LENGTH);
        }

        $this->value = $normalizedValue;
        $this->cargo = $normalizedCargo;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function cargo(): string
    {
        return $this->cargo;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value() && $this->cargo === $other->cargo();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
