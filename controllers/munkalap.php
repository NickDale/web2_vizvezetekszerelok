<?php

class Munkalap_Controller
{

	private $baseName = 'munkalap';
	public function main(array $vars)
	{
		$munkaLapModel = new Munkalap_Model;
		$helyekModel = new Helyek_Model;
		$szerelok = new Szerelo_Model;

		$view = new View_Loader($this->baseName . "_main");

		$view->assign('szerelok', $szerelok->szerelok());
		$view->assign('telepulesek', $helyekModel->telepulesek());
		$view->assign('munkalapok', $munkaLapModel->munkalapok());
	}
}
