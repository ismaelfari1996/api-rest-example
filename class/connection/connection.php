<?php
class Connection{
    private $host ;
    private $user ;
    private $password ;
    private $database ;
    private $port;
    private $connection;

    public function __construct(){
        /*
        ** This is the constructor of the class.
        ** It will be called when you create a new instance of the class.
        ** It will set the values of the private variables.
        ** It will also connect to the database.
        ** The values of the private variables are set in the config file.
        */
        $connectionData=self::getDataConnection();
        foreach($connectionData as $key=>$value){
            $this->host=$value['host'];
            $this->user=$value['user'];
            $this->password=$value['password'];
            $this->database=$value['database'];
            $this->port=$value['port'];
        }
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database,$this->port);
        if($this->connection->connect_error){
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection(){
        /*
        ** This function will return the connection to the database.
        */
        return $this->connection;
    }

    private function getDataConnection(){
        /*
        ** This function is used to get the database connection data from config file.
        ** This returns an array with the connection data.
        */
        $jsonData= file_get_contents(dirname(__FILE__) . "/config");
        return json_decode($jsonData, true);
    }
}
?>