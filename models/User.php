<?php

class user {
    private $_id ;
    private $_idSite ;
    private $_email ;
    private $_password;

    public function _construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $methode = 'set'.ucfirst($key);
            if (method_exists($this,$method)) {
                $this->method($value);
            }
        }
    }

    public function setId($id)
    {
        $id = (int) $id ;
        if($id > 0){
            $this->_id = $id ;
        }
    }

    public function setIdSite($id)
    {
        $idSite = (int) $id ;
        if($id > 0){
            $this->_id_site = $idSite ;
        }
    }

    public function setEmail($email)
    {
        if(is_string($email)){
            $this->_email = $email;
        }
    }
    
    public function setPassword($passsword)
    {
        if(is_string($email)){
            $this->_password = $password;
        }
    }
}