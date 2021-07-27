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

                if (isset($_GET['url'])) {
                    $url = explode('/',$_SERVER['PATH_INFO'],FILTER_SANITIZE_URL);
                    print_r ($url);
                    $controller = ucfirst(strtolower($url[0]));
                    $controllerClass = 'Controller'.$controller ;
                    $controllerFile = 'controllers/'.$controllerClass.'php';
                    if(file_exists($controllerFile)){
                        require_once($controllerFile);
                        $this->ctrl = new $controllerClass($url) ;
                    }
                    else{
                        throw new \Exception("page introuvable" , 1);
                    }
                }else{
                    $url = explode('/',$_SERVER['PATH_INFO'],FILTER_SANITIZE_URL);
                    print_r($url[1]);
                }
                // else{
                //     print_r ($_GET['test']);
                //     require_once('controllers/ControllerAuth.php');
                //     $this->ctrl = new ControllerAuth(null);
                // }
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