<?php 
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de la aplicación LDAP</title>
</head>
<body>
    <h1>Menú de la aplicación LDAP</h1>
    <ul>
        <li><a href="http://zend-aifrya.fjeclot.net/projecteAifrya/visualizar.php">Visualizar datos del usuario</a></li>
        <li><a href="http://zend-aifrya.fjeclot.net/projecteAifrya/agregar.php">Agregar nuevo usuario</a></li>
        <li><a href="http://zend-aifrya.fjeclot.net/projecteAifrya/eliminar.php">Eliminar usuario</a></li>
        <li><a href="http://zend-aifrya.fjeclot.net/projecteAifrya/modificar.php">Modificar usuario</a></li>
    </ul><br>
    <a href="http://zend-aifrya.fjeclot.net/projecteAifrya/index.php">Torna a la pàgina inicial</a>
</body>
</html>
