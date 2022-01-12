<?php
require_once "class/auth.class.php";
require_once "class/serverResponse.class.php";
$response=new ServerResponse();
$auth=new Auth();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $jsonData=file_get_contents('php://input');
    $response=$auth->login($jsonData);
    echo $response;
}else{
    echo "Method not allowed";
}
?>