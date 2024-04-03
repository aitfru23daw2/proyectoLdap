<!DOCTYPE html>
<html>
<head>
    <title>Modificar Atributs Usuari</title>
</head>
<body>
<h2>Modificar Atributs d'Usuari</h2>
    <form action="http://zend-aifrya.fjeclot.net/projecteAifrya/modificar.php" method="POST">
 
    UID: <input type="text" name="uid"><br>
    Unitat Organitzativa: <input type="text" name="unorg"><br>

    Atribut a modificar:<br>
    <input type="radio" name="atributModif" value="uidNumber"> uidNumber<br>
    <input type="radio" name="atributModif" value="gidNumber"> gidNumber<br>
    <input type="radio" name="atributModif" value="homeDirectory"> Directori personal<br>
    <input type="radio" name="atributModif" value="loginShell"> Shell<br>
    <input type="radio" name="atributModif" value="cn"> cn<br>
    <input type="radio" name="atributModif" value="sn"> sn<br>
    <input type="radio" name="atributModif" value="givenName"> givenName<br>
    <input type="radio" name="atributModif" value="postalAddress"> PostalAdress<br>
    <input type="radio" name="atributModif" value="mobile"> Mobil<br>
    <input type="radio" name="atributModif" value="telephoneNumber"> Telefon<br>
    <input type="radio" name="atributModif" value="title"> Titol<br>
    <input type="radio" name="atributModif" value="description"> Descripcio<br>
  
    Nou valor: <input type="text" name="nouValor"><br>
    <input type="submit" value="Modificar">
    <input type="reset" value="Neteja">
</form>
<a href="http://zend-aifrya.fjeclot.net/projecteAifrya/menu.php">Torna al menú</a>
</body>
</html>
<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

session_start(); // Iniciar la sesión

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("location: login.php");
    exit();
}

if ($_POST['uid'] && $_POST['unorg'] ) {
   
    $uid = $_POST['uid'];
    $unorg = $_POST['unorg'];
    $dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
    
    echo "<br><br>DOMINI : ".$uid.", ".$unorg.", ".$dn."<br>";
    
    $atributModif = $_POST['atributModif'];
    $nouValor = $_POST['nouValor'];

    echo "<br><br>ATRIBUT Y VALOR ".$atributModif.", ".$nouValor."<br>";
    
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-aifrya.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    
    // Connect to LDAP server
    $ldap = new Ldap($opcions);
    
    $ldap->bind();
    $entrada = $ldap->getEntry($dn);
    if ($entrada){
        Attribute::setAttribute($entrada,$atributModif,$nouValor);
        $ldap->update($dn, $entrada);
        echo "Atribut modificat"."<br>";
    } else echo "<b>Aquesta entrada no existeix</b><br><br>";
}
?>
