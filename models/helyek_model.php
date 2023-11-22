<?php

class Helyek_Model
{
	public function get_data()
	{
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			$sql = "select * from hely
			where deactivate is null;";
			$stmt = $connection->query($sql);
			$valtozo = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$retData['eredmeny'] = "ok";
			$retData['adat'] = $valtozo;
		} catch (PDOException $e) {
			$retData['eredmeny'] = "ERROR";
			$retData['uzenet'] = "Adatbázis hiba: " . $e->getMessage() . "!";
		}
		return $retData;
	}

	public function helyek()
	{
		$result = Database::getConnection()
			->query("SELECT * FROM hely")
			->fetchAll(PDO::FETCH_ASSOC);

		$helyek = [];
		foreach ($result as $row) {
			$helyek[] = new Hely($row);
		}
		return $helyek;
	}
}
