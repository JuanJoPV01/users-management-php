<?php

declare(strict_types=1);

final class PartidoPoliticoEntity
{
    private string $id;
    private string $nombre;
    private string $eslogan;
    private string $presidente;
    private string $secretario;
    private string $tesorero;
    private string $pais;
    private int $numPresidentes;
    private int $numGobernadores;
    private int $numAlcaldes;
    private int $numConcejales;
    private int $numCongresistas;
    private ?string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        string $id,
        string $nombre,
        string $eslogan,
        string $presidente,
        string $secretario,
        string $tesorero,
        string $pais,
        int $numPresidentes,
        int $numGobernadores,
        int $numAlcaldes,
        int $numConcejales,
        int $numCongresistas,
        ?string $createdAt = null,
        ?string $updatedAt = null
    ) {
        $this->id = trim($id);
        $this->nombre = trim($nombre);
        $this->eslogan = trim($eslogan);
        $this->presidente = trim($presidente);
        $this->secretario = trim($secretario);
        $this->tesorero = trim($tesorero);
        $this->pais = trim($pais);
        $this->numPresidentes = $numPresidentes;
        $this->numGobernadores = $numGobernadores;
        $this->numAlcaldes = $numAlcaldes;
        $this->numConcejales = $numConcejales;
        $this->numCongresistas = $numCongresistas;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function nombre(): string
    {
        return $this->nombre;
    }

    public function eslogan(): string
    {
        return $this->eslogan;
    }

    public function presidente(): string
    {
        return $this->presidente;
    }

    public function secretario(): string
    {
        return $this->secretario;
    }

    public function tesorero(): string
    {
        return $this->tesorero;
    }

    public function pais(): string
    {
        return $this->pais;
    }

    public function numPresidentes(): int
    {
        return $this->numPresidentes;
    }

    public function numGobernadores(): int
    {
        return $this->numGobernadores;
    }

    public function numAlcaldes(): int
    {
        return $this->numAlcaldes;
    }

    public function numConcejales(): int
    {
        return $this->numConcejales;
    }

    public function numCongresistas(): int
    {
        return $this->numCongresistas;
    }

    public function createdAt(): ?string
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?string
    {
        return $this->updatedAt;
    }
}
