<?php

class Munkalap_Model
{
	public function get_data()
	{
		$retData['eredmeny'] = "";
		try {
			$connection = Database::getConnection();
			if($_SESSION['userlevel']=='___1')
			{
				$sql = "Select * from munkalap;";
			}
			else{
				$sql = "Select * from munkalap
			inner join szerelo on szerelo.az =munkalap.szereloaz
			where szerelo.nev LIKE'".$_SESSION['userlastname']." ".$_SESSION['userfirstname']."'
            ;";

			}

			
			
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
}

?>