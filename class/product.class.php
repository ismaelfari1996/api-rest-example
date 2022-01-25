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

    public function post($data){
        $data=json_decode($data, true);
        $sql="INSERT INTO ".$this->table." (cod,product,stock,price) VALUES ('".$data['cod']."','".$data['product']."',".$data['stock'].",".$data['price'].")";

        if( $this->query->executeQuery($sql)>0){
            return true;
        }else{
            return false;
        }
        
    }
}
?>