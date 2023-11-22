<?php

class Szerelo_szerelomodosit_Controller
{

	public $baseName = 'szerelomodosit';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        
		//bet�ltj�k a n�zetet
		$view = new View_Loader($this->baseName."_main");
		$helyekModel = new Szerelo_Model;
		$view->assign('adatok', $helyekModel ->get_databyId($_GET["id"]));

	}
}

?>