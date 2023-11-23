<?php

class Admin_Controller
{
    public $baseName = 'lekeredezes';  //meghat�rozni, hogy melyik oldalon vagyunk
	public function main(array $vars) // a router �ltal tov�bb�tott param�tereket kapja
	{
        //$helyekModel = new Lekeredezes_Model;
        $helyekModel = new Szerelo_Model;
		$view = new View_Loader($this->baseName."_main");
        $view->assign('adatok', $helyekModel->get_data());
        $helyekModel1 = new Helyek_Model;
		//bet�ltj�k a n�zetet
        $view->assign('telepulesek', $helyekModel1 ->telepulesekEsId());
	
       

	}

}

?>