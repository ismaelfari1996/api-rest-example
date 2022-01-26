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
            // If the user or password is not set, return an error 400.
            return $this->response->error_400();
        }else{
            // If the user and password are set, check if the user exists.
            $data=self::getUserData($data['user']);
            if($data){
                // If the user exists, check if the password is correct.
               if($data[0]['password']==$password){
                  // If the password is correct, return the user data.
                   if($data[0]['status']=="active"){
                       // If the user is active, return the user data.
                       $verify=self::token($data[0]['iduser']);
                       if($verify!=""){
                           return[
                               "status"=>"OK",
                               "result"=>array(
                                   "token"=>$verify,
                                   "message"=>"token generated")
                           ];
                       }else{
                           return[
                               "status"=>"ERROR",
                               "result"=>array(
                                   "code"=>"500",
                                   "message"=>"Internal server error"
                               )
                           ];
                       }
                       return $this->response->success("Access granted");
                   }else{
                       // If the user is not active, return an error 403.
                       return $this->response->success("Your account is not active");
                   }
               }else{
                     // If the password is incorrect, return an error 403.
                     return $this->response->error_404("Wrong password");
                }
            }else{
                // If the user does not exist, return an error 404.
                return $this->response->error_404("User ".$user." not found");
            }
        }
    }

    public function getUserData($user){
        /*
        ** This function will return the user data.
        */
        $query="SELECT iduser,user, password,status FROM api_rest.users WHERE user='".$user."'";
        $data=$this->db->getData($query);
        if(isset($data[0]["user"])){
            return $data;
        }else{
            return 0;
        }
    }

    private function token($userId){
        /*
        ** This function will return a token.
        */
        $value=true;
        $token=bin2hex(openssl_random_pseudo_bytes(16, $value));
        $date=date("Y-m-d H:i:s");  // Get the current date.
        $query="INSERT INTO api_rest.users_token (userid,token,status, date) VALUES ('$userId','".$token."','active','".$date."')";
        $insert=$this->db->executeQuery($query);
        if($insert>0){
            return $token;
        }else{  
            return 0;
        }
    }

}
?>