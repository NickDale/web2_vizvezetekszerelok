<?php
define('BASE_URL', 'http://localhost/web2_vizvezetekszerelok/api/rest/szerelok');
// GET kérés a szerelők lekérdezésére


print_r("<br><br>=========================================== GET API TEST =================================<br><br>");
$szerelok = szerelokLekérdezése();
print_r("GET kérés eredménye: <br><br>");
printSzerelok($szerelok);


print_r("=========================================== POST API TEST =================================<br><br>");
$szereloNeve = 'TESZT_SZERELO_' . rand(1, 100);
$postData = json_encode([
    'nev' => $szereloNeve,
    'kezdesEve' => 2023
]);
$ch = curl_init(BASE_URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($postData)
]);


$newSzereloResponse = curl_exec($ch);
curl_close($ch);
print_r("válasz: " . $newSzereloResponse);

$frissitettSzerelok = szerelokLekérdezése();
$ujSzerelo;
foreach ($frissitettSzerelok as $sz2) {
    $foundInFirstList = false;

    foreach ($szerelok as $sz1) {
        if ($sz2['nev'] === $sz1['nev']) {
            $foundInFirstList = true;
            break;
        }
    }
    if (!$foundInFirstList && $sz2['nev'] === $szereloNeve) {
        $ujSzerelo = $sz2;
        break;
    }
}

print_r("Az újonnan létrehozott szerelő adatai: <br>");
printSzerelo($ujSzerelo);

print_r("Létrehozott szerelő ID-je:" . $ujSzerelo['id']);
print_r("<br>");



print_r("<br><br>=========================================== PUT API TEST =================================<br><br>");
$putData = json_encode([
    'nev' => $szereloNeve . '_új',
    'kezdesEve' => 1977
]);
$ch = curl_init(BASE_URL . '/' . $ujSzerelo['id']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $putData);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($putData)
]);
$putResponse = curl_exec($ch);
curl_close($ch);

print_r("Módosítás válasza: " . $putResponse);
print_r("<br>");


$frissitettSzerelok = szerelokLekérdezése();
$upDateltSzerelo;
foreach ($frissitettSzerelok as $sz) {
    if ($sz['id'] === $ujSzerelo['id']) {
        $upDateltSzerelo = $sz;
        break;
    }
}

print_r("Az updatelt szerelő adatai: <br>");
printSzerelo($upDateltSzerelo);

print_r("<br><br>=========================================== DELETE API TEST =================================<br><br>");
$ch = curl_init(BASE_URL . '/' . $ujSzerelo['id']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
$deleteResponse = curl_exec($ch);
curl_close($ch);

print_r("Törlés válasza: " . $deleteResponse);
print_r("<br>");


$frissitettSzerelok = szerelokLekérdezése();
$inaktiváltSzerelo;
foreach ($frissitettSzerelok as $sz) {
    if ($sz['id'] === $ujSzerelo['id']) {
        $inaktiváltSzerelo = $sz;
        break;
    }
}

print_r("Az updatelt szerelő adatai: <br>");
printSzerelo($inaktiváltSzerelo);



function printSzerelok($szerelok)
{
    foreach ($szerelok as $szerelo) {
        printSzerelo($szerelo);
    }
    print_r("<br><br>");
}

function printSzerelo($szerelo)
{
    echo 'Id: ' . $szerelo['id'] . '<br>';
    echo 'Név: ' . $szerelo['nev'] . '<br>';
    echo 'Kezdés éve: ' . $szerelo['kezdesEve'] . '<br>';
    echo 'Aktív: ' . ($szerelo['active'] ? 'Igen' : 'Nem') . '<br><br>';
}



function szerelokLekérdezése()
{
    $ch = curl_init(BASE_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $szerelok = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $szerelok;
}
