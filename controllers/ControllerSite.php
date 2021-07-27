<?php


class ControllerSite {
    
    private $UserManager ; 

    public function __construct($url)
    {
        if (isset($url)) {
            if($url === 'home'){
                $this->home();
            }
            else if($url === 'SaveSite') {
                $this->FetchSite();
            }
            else{
                $this->home();
            }
        } else {
            throw new \Exception("page introuvable",1);
        }
    }

    public function home()
    {
        require_once('./views/login.php');
    }
    public function FetchSite()
    {
        require_once('./views/register.php');
    }
}