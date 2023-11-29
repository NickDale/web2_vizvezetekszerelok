<?php


class Regisztraciofeldolgozoc_Controller
{
    public $baseName= 'felhasznalok';  //meghatározni, hogy melyik oldalon vagyunk

    public function main() // a routeráltal továbbított paramétereket kapja
    {

        $gepek= new Felhasznalok;

       if($_POST["jelszo"]==$_POST["jelszo1"])
       {
        $csaladi_nev=$_POST["csaladi_nev"];
        $utonev=$_POST["utonev"];
        $bejelentkezes=$_POST["utonev"];
        $jelszo=$_POST["jelszo"];
        $gepek->regisztacio($csaladi_nev, $utonev, $bejelentkezes, $jelszo);
        $view= new View_Loader('belepes_main');
        $view->assign('hibauzenet', "Sikerült bejelentkezni");

       }
       else
       {
        $view= new View_Loader('regisztracio_main');
                $view->assign('hibauzenet', "Nem sikerült bejelentkezni");

       }
        
     
        
    }
}
?>