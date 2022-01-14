<?php
require_once "class/serverResponse.class.php";
require_once "class/product.class.php";
$reponse=new ServerResponse();
$product=new Product();
if($_SERVER['REQUEST_METHOD']=="GET"){
    if(isset($_GET['page'])){
        //$products=$product->getProducts($_GET['page'],$_GET['quantity']); // Get products by page and quantity.
        $products=$product->getProducts($_GET['page']);
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($products);
    }else if(isset($_GET['id'])){
        $product=$product->getProductById($_GET['id']);
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($product);
    }

}else if($_SERVER['REQUEST_METHOD']=="POST"){
 echo "POST";
}else if($_SERVER['REQUEST_METHOD']=="PUT"){
    echo "PUT";
}else if($_SERVER['REQUEST_METHOD']=="DELETE"){
    echo "DELETE";
}else{
    $response=$response->error_405();
    header('Content-Type: application/json');
    http_response_code(405);
    echo json_encode($response);
}
?>