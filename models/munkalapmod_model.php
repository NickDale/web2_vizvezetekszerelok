<?php

class Munkalapmod_Model
{
	public function modify_data($az, $bedatum, $javdatum, $munkaora, $anyagar,$deactivate)
	{
		
		
			$connection = Database::getConnection();
			$sql = "UPDATE munkalap SET bedatum=?, javdatum=?, munkaora=? 
            anyagar=?, deactivate=? 
            WHERE az =?";
			$connection->prepare($sql)->execute([$bedatum, $javdatum, $munkaora, $anyagar,$deactivate,$az]);
			
		
		
		
	}
}

?>