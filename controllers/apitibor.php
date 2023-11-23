<?php

class ApiTibor_Controller
{

	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        $helyekModel = new  ApiTibor_Model;
		//bet�ltj�k a n�zetet
		
        echo json_encode($helyekModel->lekeres($_GET["szerelo"],$_GET["helyek"], $_GET["anyagar"]),JSON_UNESCAPED_UNICODE);

	}
}

?>