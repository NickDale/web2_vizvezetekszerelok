<?php

class Helyek_Controller
{

	public $baseName = 'helyek';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        $helyekModel = new Helyek_Model;
		//bet�ltj�k a n�zetet
		$view = new View_Loader($this->baseName."_main");
        $view->assign('adatok', $helyekModel ->get_data());

	}
}

?>