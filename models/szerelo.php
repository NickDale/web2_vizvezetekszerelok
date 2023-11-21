<?php

class Szerelo
{
    public int $id;
    public string $nev;
    public ?int $kezdesEve;
    public bool $active;

    public function __construct($row)
    {
        $this->id = $row['az'];
        $this->nev = $row['nev'];
        $this->kezdesEve = $row['kezdev'];
        $this->active = $row['deactivate'] == 0 ? true : false;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nev' => $this->nev,
            'kezdesEve' => $this->kezdesEve,
            'active' => $this->active
        ];
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active)
    {
        $this->active = $active;
    }

    public function getNev(): string
    {
        return $this->nev;
    }

    public function setNev(string $nev)
    {
        $this->nev = $nev;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getKezdoEv()
    {
        return $this->kezdesEve;
    }

    public function setKezdesEve(int $ev)
    {
        $this->kezdesEve = $ev;
    }
}
