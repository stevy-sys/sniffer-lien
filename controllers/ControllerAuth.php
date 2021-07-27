<?php


class ControllerAuth {
    
    private $UserManager ; 

    public function __construct($url)
    {
        if (isset($url)) {

            echo $url;
            throw new \Exception("page introuvable",1);
        } else {
            $this->login();
        }
    }

    public function login()
    {
        require_once('./views/index.php');
    }
}