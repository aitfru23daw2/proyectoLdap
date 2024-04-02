<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $uid = $_GET['uid'];
    $unorg = $_GET['unorg'];
    
    $dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
    
    $opcions = [
        'host' => 'zend-aifrya.fjeclot.net',
        'username' => 'cn=admin,dc=fjeclot,dc=net',
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['usr'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Visualizar</title>
</head>
<body>
    <h2>Visualizar usuario</h2>
    <form method="get" action="visualizar.php">
        <label for="uid">Nombre del usuario a Visualizar:</label><br>
        <input type="text" id="uid" name="uid" required><br><br>
        <label for="unorg">Unidad Organizativa del usuario:</label><br>
        <input type="text" id="unorg" name="unorg" required><br><br>
        <input type="submit" value="Visualizar">
    </form>
</body>
</html>
