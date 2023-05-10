<?php



namespace Source\Controllers;

use League\Plates\Engine;
use CoffeeCode\Router\Router;
use Source\Core\Core;
use Source\Entidades\Produto;

class homeController extends Core
{

    public function home()
    {
        //LISTAR TODOS OS PRODUTOS
        $sideBar = $this->view->render("fragments/menu-home/sideBar");
        $navBar = $this->view->render("fragments/menu-home/navBar");

        $lista = new Produto();
        $lista = $lista->listar()["data"];

        echo $this->view->render("Produto/listar", [ "sideBar" => $sideBar, "navBar" => $navBar, "produtos" => $lista ]);
    }
    
}
