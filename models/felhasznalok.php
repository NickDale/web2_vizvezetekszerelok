<?php
class Felhasznalok

{
    
    public function regisztacio($csaladi_nev, $utonev, $bejelentkezes, $jelszo)
    {
        $sikeresreg=false;
        if($_POST["jelszo"]!=$_POST["jelszo1"])
        {
            return  $sikeresreg;
        }
       
        $connection = Database::getConnection();
			$sql = "INSERT INTO felhasznalok (csaladi_nev,utonev,bejelentkezes,jelszo,jogosultsag) VALUES(?,?,?,sha1(?),?);";
			$connection->prepare($sql)->execute([$csaladi_nev, $utonev, $bejelentkezes, $jelszo,'_1__']);
       
        return  $sikeresreg;

    }

}
