<?php

class Munkalap
{
    private int $munkaLapId;
    private $beadasDatuma;
    private $javitasDatuma;
    private string $telepules;
    private string $utca;
    private string $szereloNeve;
    private ?float $munkaora;
    private ?float $anyagar;

    public function __construct($row)
    {
        $this->munkaLapId = $row['az'];
        $this->beadasDatuma = $row['bedatum'];
        $this->javitasDatuma = $row['javdatum'];
        $this->telepules = $row['telepules'];
        $this->utca = $row['utca'];
        $this->szereloNeve = $row['nev'];
        $this->munkaora = $this->getInFloat($row['munkaora']);
        $this->anyagar = $this->getInFloat($row['anyagar']);
    }


    private function getInFloat(string $data): float | null
    {
        if ($data !== '' && is_numeric($data)) {
            $floatValue = floatval($data);
            if (!is_nan($floatValue)) {
                return $floatValue;
            }
        }
        return null;
    }

    public function getMunkaLapId(): int
    {
        return $this->munkaLapId;
    }

    public function getBeadasDatuma()
    {
        return $this->beadasDatuma;
    }

    public function getJavitasDatuma()
    {
        return $this->javitasDatuma;
    }

    public function getTelepules(): string
    {
        return $this->telepules;
    }

    public function getUtca(): string
    {
        return $this->utca;
    }

    public function getSzereloNeve(): string
    {
        return $this->szereloNeve;
    }

    public function getMunkaora(): ?float
    {
        return $this->munkaora;
    }

    public function getAnyagar(): ?float
    {
        return $this->anyagar;
    }
}
