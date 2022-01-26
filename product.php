<?php
require_once "class/serverResponse.class.php";
require_once "class/product.class.php";
$response=new ServerResponse();
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
    $data=file_get_contents("php://input");
    //echo $data;
    if($product->post($data)){
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($response->success("Product created"));
    }else{
        header("Content-Type: application/json");
        http_response_code(500);
        echo json_encode($response->error_500());   
    }
    
}else if($_SERVER['REQUEST_METHOD']=="PUT"){
    $data=file_get_contents("php://input");
    //echo $data;
    if($product->put($data)){
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($response->success("Product updated"));
    }else{
        header("Content-Type: application/json");
        http_response_code(500);
        echo json_encode($response->error_500());   
    }
}else if($_SERVER['REQUEST_METHOD']=="DELETE"){
    $data=file_get_contents("php://input");
    //echo $data;
    if($product->delete($data)){
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode($response->success("Product deleted"));
    }else{
        header("Content-Type: application/json");
        http_response_code(500);
        echo json_encode($response->error_500());   
    }
}else{
    $response=$response->error_405();
    header('Content-Type: application/json');
    http_response_code(405);
    echo json_encode($response);
}
?>