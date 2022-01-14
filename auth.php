<?php
require_once "class/auth.class.php";
require_once "class/serverResponse.class.php";
$response=new ServerResponse();
$auth=new Auth();

if($_SERVER['REQUEST_METHOD']=='POST'){
    // Get the data from the request.
    $jsonData=file_get_contents('php://input');
    // set data to login.
    $response=$auth->login($jsonData);
    // Return the response.
    header('Content-Type: application/json');
    if(isset($response['result']['code'])){
        http_response_code($response['result']['code']);
    }else{
        http_response_code(200);
    }
    echo json_encode($response);
}else{
    // Return an error 405.
    $response=$response->error_405();
    header('Content-Type: application/json');
    http_response_code(405);
    echo json_encode($response);
}
?>