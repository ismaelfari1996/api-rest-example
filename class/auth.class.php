<?php
require_once "serverResponse.class.php";
require_once "databaseQuery.class.php";
class Auth{
    private $response;
    private $db;
    public function __construct(){
        $this->response=new ServerResponse();
        $this->db=new DatabaseQuery();
    }
    public function login($json){
        $data=json_decode($json, true);
        $user=$data["user"];
        $password= $this->db->getEncryptedData($data["password"]);
        if(!isset($data['user']) || !isset($data['password'])){
            return json_encode($this->response->error_400());
        }else{
            //return "OK";
            $data=self::getUserData($data['user']);
            if($data){
               if($data[0]['password']==$password){
                   return "Access granted";
               }else{
                     return json_encode($this->response->error_404("Wrong password"));
                }
            }else{
                return json_encode($this->response->error_404("User ".$user." not found"));
            }
        }
    }

    public function getUserData($user){
        $query="SELECT user, password,status FROM api_rest.users WHERE user='".$user."'";
        $data=$this->db->getData($query);
        if(isset($data[0]["user"])){
            return $data;
        }else{
            return 0;
        }
    }

}
?>