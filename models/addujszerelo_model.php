<?php

class Addujszerelo_Model
{
	public function insert_data($nev, $kezdev)
	{
		$connection = Database::getConnection();
		$sql = "INSERT INTO szerelo (nev,kezdev) VALUES(?,?);";
		$connection->prepare($sql)->execute([$nev, $kezdev]);
	}
}
