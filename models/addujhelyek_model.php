<?php

class Addujhelyek_Model
{
	public function insert_data($telepules, $utca)
	{
		
		
			$connection = Database::getConnection();
			$sql = "INSERT INTO hely (telepules,utca) VALUES(?,?);";
			$connection->prepare($sql)->execute([$telepules, $utca]);
			
		
		
		
	}
}

?>