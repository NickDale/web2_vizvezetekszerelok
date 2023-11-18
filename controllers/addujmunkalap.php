<?php

class Addujmunkalap_Controller
{

	public $baseName = 'addujmunkalap';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        $helyekModel = new Addujmunkalap_Model;
        $helyekModel->insert_data
        ($_POST["bedatum"],$_POST["javdatum"],
        $_POST["helyaz"],$_POST["szereloaz"],$_POST["munkaora"],$_POST["anyagar"]);
		//bet�ltj�k a n�zetet

		$helyekModel = new Munkalap_Model;
		$view = new View_Loader("munkalap_main");
		$view->assign('adatok', $helyekModel ->get_data());
       

	}
}

?>