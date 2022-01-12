<?php 
define('ROOT', dirname(__FILE__));
require_once "class/connection/connection.php";
require_once "class/databaseQuery.php";
$function=new DatabaseQuery();
$function->executeQuery("INSERT INTO `users` (`user`, `password`) VALUES ('test', 'test')");
$data=$function->getData("SELECT * FROM `users`");

echo json_encode($data);

?>