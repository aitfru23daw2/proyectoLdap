<?php
    require 'vendor/autoload.php';
	use Laminas\Ldap\Ldap;

	ini_set('display_errors', 0);
	session_start();
	
	if ($_POST['cts'] && $_POST['adm']){
	   $opcions = [
            'host' => 'zend-aifrya.fjeclot.net',
		    'username' => "cn=admin,dc=fjeclot,dc=net",
   		    'password' => 'fjeclot',
   		    'bindRequiresDn' => true,
		    'accountDomainName' => 'fjeclot.net',
   		    'baseDn' => 'dc=fjeclot,dc=net',
       ];	
	   $ldap = new Ldap($opcions);
	   $dn='cn='.$_POST['adm'].',dc=fjeclot,dc=net';
	   $ctsnya=$_POST['cts'];
	   try{
	       $ldap->bind($dn,$ctsnya);
	       $_SESSION['authenticated'] = true;
	       $_SESSION['username'] = $_POST['adm'];
	       header("location: menu.php");
	   } catch (Exception $e){
	       echo "<b>Contrasenya incorrecta</b><br><br>";	       
	   }
	}
?>
<html>
	<head>
		<title>
			AUTENTICACIÓ AMB LDAP 
		</title>
	</head>
	<body>
		<a href="https://zend-aifrya.fjeclot.net/projecteAifrya/index.php">Torna a la pàgina inicial</a>
	</body>
</html>
