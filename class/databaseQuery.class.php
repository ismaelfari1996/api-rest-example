<?php
include_once "class/connection/connection.php";
class DatabaseQuery{
    private $connection;
    public function __construct(){
        /*
        ** This is the constructor of the class.
        ** It will also connect to the database.
        */
        $this->connection=new Connection();
        $this->connection=$this->connection->getConnection();
    }

    public function toUTF8($array){
        /*
        ** This function will convert the array to UTF8.
        ** It will be used to convert the data from the database to UTF8.
        */
        array_walk_recursive($array, function(&$item, $key){
            if(!mb_detect_encoding($item, 'utf-8', true)){
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    public function getData($query){
        /*
        ** This function will return the data from the database.
        ** It will be used to get the data from the database.
        */
        $result = $this->connection->query($query);
        $data = array();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
        }
        return self:: toUTF8($data);
    }

    public function executeQuery($query){
        /*
        ** This function will execute the query.
        ** It will be used to execute the query.
        */
       $result=$this->connection->query($query);
       return $result->affected_rows;
    }

    private function encrypt($string){
        /*
        ** This function will encrypt the string.
        ** It will be used to encrypt the string.
        */
        
        return md5($string);
    }

    public function getEncryptedData($string){
        /*
        ** This function will return the encrypted a string.
        */

        return self:: encrypt($string);
    }

}
?>