<?php
require_once "serverResponse.class.php";
require_once "databaseQuery.class.php";

class Product{
    private $response;
    private $query;
    private $table="products";
    private $token="";
    //b0f90bbd1092328f2075b521f62d752f"
    public function __construct(){
        $this->response=new ServerResponse();
        $this->query=new DatabaseQuery();
    }

    public function getProducts($page=1,$quantity=10){
        /*
        ** Get products by page and quantity.
        */
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
        /*
        ** Get product by id.
        */
        $sql="SELECT * FROM ".$this->table." WHERE cod='".$id."'";
        $data=$this->query->getData($sql);
        if($data!=""){
            return $data;
        }else{
            return $this->response->error_404();
        }
    }

    public function post($data){
        /*
        ** Create a new product.
        */
        $data=json_decode($data, true);
        if(isset($data["token"])){
            if(self::searchToken($data["token"])){
                $sql="INSERT INTO ".$this->table." (cod,product,stock,price) VALUES ('".$data['cod']."','".$data['product']."',".$data['stock'].",".$data['price'].")";
                if( $this->query->executeQuery($sql)>0){
                    return true;
                }else{
                    return false;
                }
            }else{
            return $this->response->error_401();
            }
        }else{
            return false;
        }
        
    }

    public function put($json){
        /*
        ** Update a product.
        */
        $data=json_decode($json, true);
        if(isset($data["token"])){
            if(self::searchToken($data["token"])){
                $sql="UPDATE ".$this->table." SET product='".$data['product']."',stock=".$data['stock'].",price=".$data['price']." WHERE cod='".$data['cod']."'";
                if( $this->query->executeQuery($sql)>0){
                    return true;
                }else{
                    return false;
                }
            }else{
            return $this->response->error_401();
            }
       }else{
            return false;
        }

    }

    public function delete($json){
        /*
        ** Delete a product.
        */
        $data=json_decode($json, true);
        if(isset($data["token"])){
            if(self::searchToken($data["token"])){
                $sql="DELETE FROM ".$this->table." WHERE cod='".$data["cod"]."'";
                if( $this->query->executeQuery($sql)>0){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    private function searchToken($token){
        /*
        ** Search token in database.
        */
        $sql="SELECT * FROM users_token WHERE token='".$token."' and status='active'";
        $data=$this->query->getData($sql);
        if(count($data)>0){
            return true;
        }else{
            return false;
        }

    }
}
?>