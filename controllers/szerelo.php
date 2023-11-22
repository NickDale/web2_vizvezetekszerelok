<?php

class Szerelo_Controller
{
	private $baseName = 'szerelo';
	public function main(array $vars)
	{
		$szereloModel = new Szerelo_Model;
		$view = new View_Loader($this->baseName . "_main");
		$view->assign('adatok', $szereloModel->get_data());
		$view->assign('szerelokEsMunkak', $szereloModel->szerelokEsBefejezetttMunkak());
	}
}
