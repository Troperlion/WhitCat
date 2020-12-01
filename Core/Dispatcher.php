<?php

class Dispatcher {

    public $vars = [];
    public $route;
    public bool $rendered = false;


    public function __construct() {
        
        Router::path();
        $route = Router::$Route;
        foreach($route as $k=>$v) {
            $this->route->$k = $v;
        }

        ob_start();
        
        $Controllers = ucfirst($this->route->controllers).'_Controllers';
        $action = $this->route->action;

        require 'Controllers.php';
        require CONTROLLER.$Controllers.'.php';

        $this->controller = new $Controllers($this->route);
        $metod = get_class_methods($this->controller);

        if(!in_array($this->route->action,array_diff($metod,get_class_methods('Controllers')))) {
            debug('Error : La method demandé n\'éxiste pas.');
        }
        call_user_func_array([$this->controller, $action],$this->route->params);


        $content_to_htm = ob_get_clean();


        require LAYOUT.'View/'.Config::$conf['Layout_Default'].'.php';

        $this->rendered = true;
    }
};