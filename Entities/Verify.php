<?php
class Verify
{


    //Post properties
    private $email;
    private $code;
    private $created_at;

    //constructor with DB
    public function __construct()
    {
    }
    
    //set id
    public function setEmail($email){
        $this->email = $email;
    }
    //get id
    public function getEmail(){
        return $this->email;
    }

    //set Name
    public function setCode($code){
        $this->code = $code;
    }
    //get Name
    public function getCode(){
        return $this->code;
    }

    //set Phone
    public function setCreated_at($created_at){
        $this->created_at = $created_at;
    }
    //get Phone
    public function getCreated_at(){
        return $this->created_at;
    }
}