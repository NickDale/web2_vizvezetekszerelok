<?php

class Munkalapmod_Controller
{

	public $baseName = 'munkalapmod';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        $helyekModel = new Munkalapmod_Model;
        $helyekModel->modify_data($_POST["az"],$_POST["nev"],$_POST["kezdev"],$_POST["deactivate"]);
		//bet�ltj�k a n�zetet

		$helyekModel = new Munkalap_Model;
		$view = new View_Loader("munkalap_main");
		$view->assign('adatok', $helyekModel ->get_data());
       

	}
}

?>