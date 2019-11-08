<?php
$host_name = "localhost";
$database = "aiw";
$username = "root";
$password = "Linhngoc_98";

try {
    $driver_options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $dbo = new PDO('mysql:host='.$host_name.';dbname='.$database, $username, $password,$driver_options);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>