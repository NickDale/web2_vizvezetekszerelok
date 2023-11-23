<?php

class ApiTibor_Model
{
	public function lekeres($nev, $telepules,$anyagar)
	{
		
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			$sql = "SELECT hely.telepules, munkalap.anyagar FROM hely
            INNER JOIN munkalap on munkalap.helyaz = hely.az
            INNER JOIN szerelo on munkalap.szereloaz =szerelo.az
            WHERE szerelo.nev LIKE '%$nev%'
            and
            hely.telepules like '%$telepules%'
            AND
            munkalap.anyagar>$anyagar
            GROUP BY hely.telepules
            ";
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
}
