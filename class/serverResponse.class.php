<?php
class ServerResponse{
    private $response=[
        "status"=>"OK",
        "result"=>array()
    ];

    public function error_405(){
        /*
        ** This function will return an error 405.
        */
        $this->response["status"]="ERROR";
        $this->response["result"]=array(
            "code"=>"405",
            "message"=>"Method not allowed"
        );
        return $this->response;
    }

    public function error_400(){
        /*
        ** This function will return an error 400.
        */
        $this->response["status"]="ERROR";
        $this->response["result"]=array(
            "code"=>"400",
            "message"=>"Bad request"
        );
        return $this->response;
    }

    public function error_404(){
        /*
        ** This function will return an error 404.
        */
        $this->response["status"]="ERROR";
        $this->response["result"]=array(
            "code"=>"404",
            "message"=>"Not found"
        );
        return $this->response;
    }

    public function error_500(){
        /*
        ** This function will return an error 500.
        */
        $this->response["status"]="ERROR";
        $this->response["result"]=array(
            "code"=>"500",
            "message"=>"Internal server error"
        );
        return $this->response;
    }

    public function success($data){
        /*
        ** This function will return the data.
        */
        $this->response["status"]="OK";
        $this->response["result"]=$data;
        return $this->response;
    }



}
?>