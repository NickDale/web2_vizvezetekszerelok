<?php

class Munkalap_Model
{
	public function get_data()
	{
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			if ($_SESSION['userlevel'] == '___1') {
				$sql = "Select * from munkalap;";
			} else {
				$sql = "Select * from munkalap
			inner join szerelo on szerelo.az =munkalap.szereloaz
			where szerelo.nev LIKE'" . $_SESSION['userlastname'] . " " . $_SESSION['userfirstname'] . "'
            ;";
			}

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
	public function get_databyId($id)
	{

		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			if($_SESSION['userlevel']=='___1')
			{
				$sql = "Select * from munkalap
				where az=$id;";
			}
			else
			{
				$sql = "select * from munkalap
			where az=$id
			and deactivate=0
			;";

			}

			
			$stmt = $connection->query($sql);
			$valtozo= $stmt->fetch(PDO::FETCH_ASSOC);
            $retData['eredmeny'] = "ok";
            $retData['adat']=$valtozo;
			
		}
		catch (PDOException $e) {
					$retData['eredmeny'] = "ERROR";
					$retData['uzenet'] = "Adatbázis hiba: ".$e->getMessage()."!";
		}
		return $retData;
	}


	public function munkalapok()
	{
		$sql = "SELECT m.az, m.bedatum, m.javdatum, m.munkaora,
		m.anyagar, sz.nev, h.telepules, h.utca    
		FROM `munkalap` m 
		Inner JOIN szerelo sz ON sz.az = m.szereloaz 
		INNER JOIN hely h ON h.az = m.helyaz";

		if (!$_SESSION['userlevel'] == '___1') {
			$sql .= " WHERE sz.nev LIKE'" . $_SESSION['userlastname'] . " " . $_SESSION['userfirstname'] . "';";
		}

		$result  = Database::getConnection()
			->query($sql)
			->fetchAll(PDO::FETCH_ASSOC);

		$munkalapok = [];
		foreach ($result as $row) {
			$munkalapok[] = new Munkalap($row);
		}
		return $munkalapok;
	}

	public function filter($szereloId, $telepules, bool $befejeztett)
	{
		$sql = "SELECT m.az, m.bedatum, m.javdatum, m.munkaora,
		m.anyagar, sz.nev, h.telepules, h.utca    
		FROM `munkalap` m 
		Inner JOIN szerelo sz ON sz.az = m.szereloaz 
		INNER JOIN hely h ON h.az = m.helyaz ";

		$sql .= $this->conditions($szereloId, $telepules, $befejeztett);

		$parameters = [];
		if (!empty($szereloId)) {
			$parameters[] = $szereloId;
		}

		if (!empty($telepules)) {
			$parameters[] = $telepules;
		}

		if (!$_SESSION['userlevel'] == '___1') {
			$userFullName = "%" . $_SESSION['userlastname'] . " " . $_SESSION['userfirstname'] . "%";
			$parameters[] = $userFullName;
		}

		$stmt   = Database::getConnection()->prepare($sql);
		$stmt->execute($parameters);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$munkalapok = [];
		foreach ($results as $row) {
			$munkalapok[] = new Munkalap($row);
		}
		return $munkalapok;
	}


	private function conditions($szereloId, $telepules, $befejeztett): string
	{
		$conditions = [];

		if (!empty($szereloId)) {
			$conditions[] = " sz.az = ? ";
		}

		if (!empty($telepules)) {
			$conditions[] = " h.telepules = ? ";
		}

		if (!empty($befejeztett)  || $befejeztett == 1) {
			$conditions[] = " m.javdatum IS NOT NULL ";
		}

		$sql = '';
		if (!empty($conditions)) {
			$sql .= " WHERE " . implode(" AND ", $conditions);
		}

		if (!$_SESSION['userlevel'] == '___1') {
			if (!empty($conditions)) {
				$sql .= " AND ";
			} else {
				$sql .= " WHERE ";
			}
			$sql .= "sz.nev = ? ";
		}

		return $sql;
	}
}
