<?php

class Addujszerelo_Controller
{

	public $baseName = 'addujszerelo';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        $helyekModel = new Addujszerelo_Model;
        $helyekModel->insert_data($_POST["nev"],$_POST["kezdev"]);
		//bet�ltj�k a n�zetet

		$helyekModel = new Szerelo_Model;
		$view = new View_Loader("szerelo_main");
		$view->assign('adatok', $helyekModel ->get_data());
       

	}
}

?>