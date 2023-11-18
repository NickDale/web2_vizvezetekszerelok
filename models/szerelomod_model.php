<?php

class Addujszerelo_Model
{
	public function modify_data($az, $nev, $kezdev,$deactivate)
	{
		
		
			$connection = Database::getConnection();
			$sql = "UPDATE szerelo SET nev=?, kezdev=?, deactivate	=? WHERE az =?";
			$connection->prepare($sql)->execute([$nev, $kezdev,$deactivate,$az]);
			
		
		
		
	}
}

?>