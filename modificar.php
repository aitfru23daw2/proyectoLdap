<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;


ini_set('display_errors', 0);

if ($_POST['uid'] && $_POST['unorg'] ) {
   
    $uid = $_POST['uid'];
    $unorg = $_POST['unorg'];
    $dn = 'uid=' . $uid . ',ou=' . $unorg . ',dc=fjeclot,dc=net';
    
    $atributModif = $_POST['atributModif'];
    $nouValor = $_POST['nouValor'];

    
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
    $$ldap = new Ldap($opcions);
    
    $ldap->bind();
    $entrada = $ldap->getEntry($dn);
    if ($entrada){
        Attribute::setAttribute($entrada,$atributModif,$nouValor);
        $ldap->update($dn, $entrada);
        echo "Atribut modificat";
    } else echo "<b>Aquesta entrada no existeix</b><br><br>";
}
?>
<html>
<head>
    <title>Modificar Atributs Usuari</title>
</head>
<body>
<h2>Modificar Atributs d'Usuari</h2>
    <form action="http://zend-aifrya.fjeclot.net/projecteAifrya/modificar.php" method="POST">
    UID: <input type="text" name="uid"><br>
    Unitat Organitzativa: <input type="text" name="unorg"><br>
    Atribut a modificar:
    <select name="atributModif">
        <option value="uidNumber">uidNumber</option>
        <option value="gidNumber">gidNumber</option>
        <option value="homeDirectory">Directori personal</option>
        <option value="loginShell">Shell</option>
        <option value="cn">cn</option>
        <option value="sn">sn</option>
        <option value="givenName">givenName</option>
        <option value="postalAddress">PostalAdress</option>
        <option value="mobile">Mobil</option>
        <option value="telephoneNumber">Telefon</option>
        <option value="title">Titol</option>
        <option value="description">Descripcio</option>
    </select><br>
    Nou valor: <input type="text" name="nouValor"><br>
    <input type="submit" value="Modificar">
    <input type="reset" value="Neteja">
</form>
<a href="http://zend-aifrya.fjeclot.net/projecteAifrya/menu.php">Torna al menú</a>
</body>
</html>
