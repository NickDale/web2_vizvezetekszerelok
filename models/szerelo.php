<?php

class Szerelo
{
    private int $id;
    private string $nev;
    private ?int $kezdesEve;
    private bool $active;

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
}
