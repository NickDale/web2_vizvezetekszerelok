<?php

class Hely
{
    public int $helyId;
    public string $telepules;
    public string $utca;

    public function __construct($row)
    {
        $this->helyId = $row['az'];
        $this->telepules = $row['telepules'];
        $this->utca = $row['utca'];
    }
}
