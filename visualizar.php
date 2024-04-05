<?php

require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

session_start(); // Iniciar la sesión

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("location: login.php");
    exit();
}

ini_set('display_errors', 0);

if ($_GET['uid'] && $_GET['unorg'] ) {
    
    
    $dn = 'uid=' . $_GET['uid'] . ',ou=' . $_GET['unorg'] . ',dc=fjeclot,dc=net';
    
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
    $entrada='uid='.$_GET['uid'].',ou='.$_GET['unorg'].',dc=fjeclot,dc=net';
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
    <form action="https://zend-aifrya.fjeclot.net/projecteAifrya/visualizar.php" method="GET">
        <label for="uid">Uid del usuario a Visualizar:</label><br>
        <input type="text" id="uid" name="uid" required><br><br>
        <label for="unorg">Unidad Organizativa del usuario:</label><br>
        <input type="text" id="unorg" name="unorg" required><br><br>
        <input type="submit" value="Visualizar">
    </form><br>
     <a href="https://zend-aifrya.fjeclot.net/projecteAifrya/menu.php">Torna al menú</a>
</body>
</html>
