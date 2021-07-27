<?php
    class Router 
    {
        private $ctrl ;
        private $view ;

        public function routeReq()
        {

            try {
                //chargement automatique des dossier class
                spl_autoload_register(function ($class)
                {
                    require_once('models/'.$class.'.php');
                });

                //variable url
                $url = '' ;

                if (isset($_SESSION['email'])) {
                    $url = explode('/',$_GET['action'],FILTER_SANITIZE_URL);

                    
                    $controller = ucfirst(strtolower($url[1]));
                    $controllerClass = 'Controller'.$controller ;
                    $controllerFile = 'controllers/'.$controllerClass.'php';


                    if(file_exists($controllerFile)){
                        require_once($controllerFile);
                        $this->ctrl = new $controllerClass($url);
                    }
                    else{
                        throw new \Exception("page introuvable" , 1);
                    }
                }
                else{
                    require_once('controllers/ControllerAuth.php');
                    if (!isset($_GET['action'])) {
                        return $this->ctrl = new ControllerAuth('register');
                    }
                    else{
                        $url = explode('/auth',$_GET['action'],FILTER_SANITIZE_URL);
                        if ($url[0] === 'login') {
                            return $this->ctrl = new ControllerAuth('login');
                        }
                        else if ($url[0] === 'register') {
                            return $this->ctrl = new ControllerAuth('register');
                        }
                        else{
                            throw new \Exception("page introuvable" , 1);
                        }
                    }
                }
            } catch (\Throwable $e) {
                $error = $e->getMessage();
                echo $error ;
                //require_once('views/viewError.php');
            }
        }
    }

?>

<?php

    $router = new Router();
    $router-> routeReq();
?>