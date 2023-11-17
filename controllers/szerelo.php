<?php

class Szerelo_Controller
{

	public $baseName = 'szerelo';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        $helyekModel = new Szerelo_Model;
		//bet�ltj�k a n�zetet
		$view = new View_Loader($this->baseName."_main");
        $view->assign('adatok', $helyekModel ->get_data());

	}
}

?>