<?php


class ControllerAuth {
    
    private $UserManager ; 

    public function __construct($url)
    {
        if (isset($url)) {
            if($url === 'login'){
                $this->login();
            }
            else{
                $this->register();
            }
        } else {
            throw new \Exception("page introuvable",1);
        }
    }

    public function login()
    {
        require_once('./views/login.php');
    }
    public function register()
    {
        require_once('./views/register.php');
    }
}