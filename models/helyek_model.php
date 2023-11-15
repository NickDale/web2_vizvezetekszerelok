<?php

class Helyek_Model
{
	public function get_data()
	{
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			$sql = "select * from hely;";
			$stmt = $connection->query($sql);
			$valtozo= $stmt->fetchAll(PDO::FETCH_ASSOC);
            $retData['eredmeny'] = "ok";
            $retData['adat']=$valtozo;
			
		}
		catch (PDOException $e) {
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
		}
		return $retData;
	}
}

?>