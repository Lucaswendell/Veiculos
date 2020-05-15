<?php
namespace Source\Controller;

use League\Plates\Engine;

abstract class Controller
{
    protected $view;
    
    protected $router;

    protected function __construct($router){
        $this->router = $router;

        $this->view = Engine::create(dirname(__DIR__, 2) . "/template", "php");

        $this->view->addData(["router", $this->router]);
    }

    protected function ajaxResponse(string $param, array $values) : string
    {  
        return json_encode([$param => $values]);
    }
}