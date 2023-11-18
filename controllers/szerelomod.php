<?php

class Szerelomod_Controller
{

	public $baseName = 'szerelomod';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        $helyekModel = new Szerelomod_Model;
        $helyekModel->modify_data($_POST["az"].$_POST["nev"],$_POST["kezdev"],$_POST["deactivate"]);
		//bet�ltj�k a n�zetet

		$helyekModel = new Szerelo_Model;
		$view = new View_Loader("szerelo_main");
		$view->assign('adatok', $helyekModel ->get_data());
       

	}
}

?>