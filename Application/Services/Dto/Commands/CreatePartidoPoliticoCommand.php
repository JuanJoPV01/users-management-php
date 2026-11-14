<?php

declare(strict_types=1);

final class CreatePartidoPoliticoCommand
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
        int $numCongresistas
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
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getEslogan(): string
    {
        return $this->eslogan;
    }

    public function getPresidente(): string
    {
        return $this->presidente;
    }

    public function getSecretario(): string
    {
        return $this->secretario;
    }

    public function getTesorero(): string
    {
        return $this->tesorero;
    }

    public function getPais(): string
    {
        return $this->pais;
    }

    public function getNumPresidentes(): int
    {
        return $this->numPresidentes;
    }

    public function getNumGobernadores(): int
    {
        return $this->numGobernadores;
    }

    public function getNumAlcaldes(): int
    {
        return $this->numAlcaldes;
    }

    public function getNumConcejales(): int
    {
        return $this->numConcejales;
    }

    public function getNumCongresistas(): int
    {
        return $this->numCongresistas;
    }
}
