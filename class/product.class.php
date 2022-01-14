<?php
require_once "serverResponse.class.php";
require_once "databaseQuery.class.php";

class Product{
    private $response;
    private $query;
    private $table="products";
    public function __construct(){
        $this->response=new ServerResponse();
        $this->query=new DatabaseQuery();
    }

    public function getProducts($page=1,$quantity=10){
        $start=0;
        if($page>1){
            $start=(($page-1)*$quantity);
        }
        $sql="SELECT * FROM ".$this->table." LIMIT $start,$quantity";
        $data=$this->query->getData($sql);
        if($data!=""){
            return $data;
        }else{
            return $this->response->error_404();
        }
    }

    public function getProductById($id){
        $sql="SELECT * FROM ".$this->table." WHERE cod='".$id."'";
        $data=$this->query->getData($sql);
        if($data!=""){
            return $data;
        }else{
            return $this->response->error_404();
        }
    }
}
?>