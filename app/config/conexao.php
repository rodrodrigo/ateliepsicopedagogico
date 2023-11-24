<?php
function getPDOConnection() {
    $host = "144.217.39.54";
    $user = "hostdeprojetos";
    $pass = "ifspgru@2022";
    $dbname = "hostdeprojetos_dbatelie";

    try {
        $connection = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch(PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
        return null;
    }
}

$pdoConnection = getPDOConnection();

?>


