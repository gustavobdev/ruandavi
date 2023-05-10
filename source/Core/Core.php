<?php

namespace Source\Core;


use League\Plates\Engine;

class Core
{

    protected $view;
    protected $router;

    public function __construct($router)
    {

        $this->view = new Engine(dirname(__DIR__,1)."/Theme");
        $this->router=$router;

        $this->view->addData(["router"=> $this->router]);

    }

}