<?php

class Addujhelyek_Controller
{

	public $baseName = 'addujhelyek';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        $helyekModel = new Addujhelyek_Model;
        $helyekModel->insert_data($_POST["telepules"],$_POST["utca"]);
		//bet�ltj�k a n�zetet

		$helyekModel = new Helyek_Model;
		$view = new View_Loader("helyek_main");
		$view->assign('adatok', $helyekModel ->get_data());
       

	}
}

?>