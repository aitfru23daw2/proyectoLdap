<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
#Dades de la nova entrada
#
session_start(); // Iniciar la sesión

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("location: login.php");
    exit();
}

    if ($_POST['uid'] && $_POST['unorg'] ) {
    $uid = $_POST['uid'];
    $unorg = $_POST['unorg'];
    $num_id = $_POST['num_id'];
    $grup = $_POST['grup'];
    $dir_pers = $_POST['dir_pers'];
    $sh = $_POST['sh'];
    $cn = $_POST['cn'];
    $sn = $_POST['sn'];
    $nom = $_POST['nom'];
    $mobil = $_POST['mobil'];
    $adreça = $_POST['adreça'];
    $telefon = $_POST['telefon'];
    $titol = $_POST['titol'];
    $descripcio = $_POST['descripcio'];
    $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
    #
    #Afegint la nova entrada
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-aifrya.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
    Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $nom);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $adreça);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
    Attribute::setAttribute($nova_entrada, 'title', $titol);
    Attribute::setAttribute($nova_entrada, 'description', $descripcio);
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    if($ldap->add($dn, $nova_entrada)) {
        echo "Usuari creat";
    } else {
        echo "Error en la creació de l'usuari";
    }
}
?>

<html>
	<head>
		<title>Crear</title>
	</head>
	<body>
        <h2>Crear Usuari</h2>
        <form action="http://zend-aifrya.fjeclot.net/projecteAifrya/agregar.php" method="POST">
            UID: <input type="text" name="uid"><br>
            OU: <input type="text" name="unorg"><br>
            ID Numèrica: <input type="text" name="num_id"><br>
            ID Grup: <input type="text" name="grup"><br>
            Directori Personal: <input type="text" name="dir_pers"><br>
            Shell: <input type="text" name="sh"><br>
            CN: <input type="text" name="cn"><br>
            SN: <input type="text" name="sn"><br>
            Nom: <input type="text" name="nom"><br>
            Mobil: <input type="text" name="mobil"><br>
            Adreça: <input type="text" name="adreça"><br>
            Telèfon: <input type="text" name="telefon"><br>
            Títol: <input type="text" name="titol"><br>
            Descripció: <input type="text" name="descripcio"><br>
            <input type="submit" value="Envia">
            <input type="reset" value="Neteja">
        </form>
        <br>
     <a href="https://zend-aifrya.fjeclot.net/projecteAifrya/menu.php">Torna al menú</a>

	</body>
</html>
