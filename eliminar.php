<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

if ($_POST['unorg'] && $_POST['uid'] ) {
    $uid = $_POST['uid'];  // Posar usr?
    $unorg = $_POST['unorg']; // Posar usuaris
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
    try{
        $ldap->delete($dn);
        echo "<b>Entrada esborrada</b><br>";
    } catch (Exception $e){
        echo "<b>Aquesta entrada no existeix</b><br>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar</title>
</head>
<body>
    <h2>Eliminar usuaio</h2>
    <form action="http://zend-aifrya.fjeclot.net/projecteAifrya/eliminar.php" method="POST">
        <label for="uid">Nombre del usuario a eliminar:</label><br>
        <input type="text" id="uid" name="uid"><br><br>
        <label for="uid">Unidad Organizativa del usuario:</label><br>
        <input type="text" id="unorg" name="unorg"><br><br>
        <input type="submit" value="Eliminar">
    </form>
    <a href="http://zend-aifrya.fjeclot.net/projecteAifrya/menu.php">Torna al menú</a>
</body>
</html>
