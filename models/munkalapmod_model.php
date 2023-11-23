<?php

class Munkalapmod_Model
{
	public function modify_data($az, $bedatum, $javdatum, $deactivate,
    $helyaz, $nev, $kezdev,$deactivate)
	{
		
		
			$connection = Database::getConnection();
			$sql = "UPDATE munkalap SET bedatum=?, kezdev=?, deactivate	=? 
            bedatum=?, kezdev=?, deactivate	=? ,
            WHERE az =?";
			$connection->prepare($sql)->execute([$nev, $kezdev,$deactivate,$az]);
			
		
		
		
	}
}

?>