<?php

class Addujmunkalap_Model
{
	public function insert_data($bedatum, $javdatum,$helyaz, $szereloaz,$munkaora, $anyagar)
	{
		
		
			$connection = Database::getConnection();
			$sql = "INSERT INTO munkalap (bedatum,javdatum,helyaz,szereloaz,munkaora,anyagar) 
            VALUES(?,?,?,?,?,?);";
			$connection->prepare($sql)->execute([$bedatum, $javdatum,$helyaz,$szereloaz,$munkaora,$anyagar]);
			
		
		
		
	}
}

?>