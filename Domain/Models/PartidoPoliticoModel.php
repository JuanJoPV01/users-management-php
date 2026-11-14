<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/PartidoPoliticoId.php';
require_once __DIR__ . '/../ValueObjects/PartidoPoliticoNombre.php';
require_once __DIR__ . '/../ValueObjects/PartidoPoliticoEslogan.php';
require_once __DIR__ . '/../ValueObjects/PartidoPoliticoDirigente.php';
require_once __DIR__ . '/../ValueObjects/PartidoPoliticoPais.php';
require_once __DIR__ . '/../ValueObjects/PartidoPoliticoCifra.php';

final class PartidoPoliticoModel
{
    private PartidoPoliticoId $id;
    private PartidoPoliticoNombre $nombre;
    private PartidoPoliticoEslogan $eslogan;
    private PartidoPoliticoDirigente $presidente;
    private PartidoPoliticoDirigente $secretario;
    private PartidoPoliticoDirigente $tesorero;
    private PartidoPoliticoPais $pais;
    private PartidoPoliticoCifra $numPresidentes;
    private PartidoPoliticoCifra $numGobernadores;
    private PartidoPoliticoCifra $numAlcaldes;
    private PartidoPoliticoCifra $numConcejales;
    private PartidoPoliticoCifra $numCongresistas;

    public function __construct(
        PartidoPoliticoId $id,
        PartidoPoliticoNombre $nombre,
        PartidoPoliticoEslogan $eslogan,
        PartidoPoliticoDirigente $presidente,
        PartidoPoliticoDirigente $secretario,
        PartidoPoliticoDirigente $tesorero,
        PartidoPoliticoPais $pais,
        PartidoPoliticoCifra $numPresidentes,
        PartidoPoliticoCifra $numGobernadores,
        PartidoPoliticoCifra $numAlcaldes,
        PartidoPoliticoCifra $numConcejales,
        PartidoPoliticoCifra $numCongresistas
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->eslogan = $eslogan;
        $this->presidente = $presidente;
        $this->secretario = $secretario;
        $this->tesorero = $tesorero;
        $this->pais = $pais;
        $this->numPresidentes = $numPresidentes;
        $this->numGobernadores = $numGobernadores;
        $this->numAlcaldes = $numAlcaldes;
        $this->numConcejales = $numConcejales;
        $this->numCongresistas = $numCongresistas;
    }

    public static function create(
        PartidoPoliticoId $id,
        PartidoPoliticoNombre $nombre,
        PartidoPoliticoEslogan $eslogan,
        PartidoPoliticoDirigente $presidente,
        PartidoPoliticoDirigente $secretario,
        PartidoPoliticoDirigente $tesorero,
        PartidoPoliticoPais $pais,
        PartidoPoliticoCifra $numPresidentes,
        PartidoPoliticoCifra $numGobernadores,
        PartidoPoliticoCifra $numAlcaldes,
        PartidoPoliticoCifra $numConcejales,
        PartidoPoliticoCifra $numCongresistas
    ): self {
        return new self(
            $id,
            $nombre,
            $eslogan,
            $presidente,
            $secretario,
            $tesorero,
            $pais,
            $numPresidentes,
            $numGobernadores,
            $numAlcaldes,
            $numConcejales,
            $numCongresistas
        );
    }

    public function id(): PartidoPoliticoId
    {
        return $this->id;
    }

    public function nombre(): PartidoPoliticoNombre
    {
        return $this->nombre;
    }

    public function eslogan(): PartidoPoliticoEslogan
    {
        return $this->eslogan;
    }

    public function presidente(): PartidoPoliticoDirigente
    {
        return $this->presidente;
    }

    public function secretario(): PartidoPoliticoDirigente
    {
        return $this->secretario;
    }

    public function tesorero(): PartidoPoliticoDirigente
    {
        return $this->tesorero;
    }

    public function pais(): PartidoPoliticoPais
    {
        return $this->pais;
    }

    public function numPresidentes(): int
    {
        return $this->numPresidentes->value();
    }

    public function numGobernadores(): int
    {
        return $this->numGobernadores->value();
    }

    public function numAlcaldes(): int
    {
        return $this->numAlcaldes->value();
    }

    public function numConcejales(): int
    {
        return $this->numConcejales->value();
    }

    public function numCongresistas(): int
    {
        return $this->numCongresistas->value();
    }

    public function changeNombre(PartidoPoliticoNombre $nombre): self
    {
        return new self(
            $this->id,
            $nombre,
            $this->eslogan,
            $this->presidente,
            $this->secretario,
            $this->tesorero,
            $this->pais,
            $this->numPresidentes,
            $this->numGobernadores,
            $this->numAlcaldes,
            $this->numConcejales,
            $this->numCongresistas
        );
    }

    public function changeEslogan(PartidoPoliticoEslogan $eslogan): self
    {
        return new self(
            $this->id,
            $this->nombre,
            $eslogan,
            $this->presidente,
            $this->secretario,
            $this->tesorero,
            $this->pais,
            $this->numPresidentes,
            $this->numGobernadores,
            $this->numAlcaldes,
            $this->numConcejales,
            $this->numCongresistas
        );
    }

    public function changePresidente(PartidoPoliticoDirigente $presidente): self
    {
        return new self(
            $this->id,
            $this->nombre,
            $this->eslogan,
            $presidente,
            $this->secretario,
            $this->tesorero,
            $this->pais,
            $this->numPresidentes,
            $this->numGobernadores,
            $this->numAlcaldes,
            $this->numConcejales,
            $this->numCongresistas
        );
    }

    public function changeSecretario(PartidoPoliticoDirigente $secretario): self
    {
        return new self(
            $this->id,
            $this->nombre,
            $this->eslogan,
            $this->presidente,
            $secretario,
            $this->tesorero,
            $this->pais,
            $this->numPresidentes,
            $this->numGobernadores,
            $this->numAlcaldes,
            $this->numConcejales,
            $this->numCongresistas
        );
    }

    public function changeTesorero(PartidoPoliticoDirigente $tesorero): self
    {
        return new self(
            $this->id,
            $this->nombre,
            $this->eslogan,
            $this->presidente,
            $this->secretario,
            $tesorero,
            $this->pais,
            $this->numPresidentes,
            $this->numGobernadores,
            $this->numAlcaldes,
            $this->numConcejales,
            $this->numCongresistas
        );
    }

    public function changePais(PartidoPoliticoPais $pais): self
    {
        return new self(
            $this->id,
            $this->nombre,
            $this->eslogan,
            $this->presidente,
            $this->secretario,
            $this->tesorero,
            $pais,
            $this->numPresidentes,
            $this->numGobernadores,
            $this->numAlcaldes,
            $this->numConcejales,
            $this->numCongresistas
        );
    }

    public function changeCifras(
        PartidoPoliticoCifra $numPresidentes,
        PartidoPoliticoCifra $numGobernadores,
        PartidoPoliticoCifra $numAlcaldes,
        PartidoPoliticoCifra $numConcejales,
        PartidoPoliticoCifra $numCongresistas
    ): self {
        return new self(
            $this->id,
            $this->nombre,
            $this->eslogan,
            $this->presidente,
            $this->secretario,
            $this->tesorero,
            $this->pais,
            $numPresidentes,
            $numGobernadores,
            $numAlcaldes,
            $numConcejales,
            $numCongresistas
        );
    }

    public function toArray(): array
    {
        return array(
            'id' => $this->id->value(),
            'nombre' => $this->nombre->value(),
            'eslogan' => $this->eslogan->value(),
            'presidente' => $this->presidente->value(),
            'secretario' => $this->secretario->value(),
            'tesorero' => $this->tesorero->value(),
            'pais' => $this->pais->value(),
            'num_presidentes' => $this->numPresidentes->value(),
            'num_gobernadores' => $this->numGobernadores->value(),
            'num_alcaldes' => $this->numAlcaldes->value(),
            'num_concejales' => $this->numConcejales->value(),
            'num_congresistas' => $this->numCongresistas->value(),
        );
    }
}
