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

	public function telepulesek()
	{
		$result = Database::getConnection()
			->query("SELECT DISTINCT h.telepules FROM hely h")
			->fetchAll(PDO::FETCH_ASSOC);

		$telepulesek = [];
		foreach ($result as $row) {
			$telepulesek[] = $row["telepules"];
		}
		return $telepulesek;
	}
	public function telepulesekEsId()
	{
		$result = Database::getConnection()
			->query("SELECT DISTINCT h.telepules FROM hely h")
			->fetchAll(PDO::FETCH_ASSOC);

		$telepulesek = [];
		foreach ($result as $row) {
			$telepulesek[] = $row;
		}
		return $telepulesek;
	}
}
