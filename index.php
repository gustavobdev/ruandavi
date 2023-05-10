<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

session_start();

$router = new Router(ROOT);

$router->group(null)->namespace("Source\Controllers");
$router->get("/", "homeController:home", "homeController.home");


$router->group('produto')->namespace("Source\Controllers");

$router->get("/criar", "produtoController:criar", "produtoController.criar");
$router->post("/cadastrar", "produtoController:cadastrar", "produtoController.cadastrar");

$router->post("/remover", "produtoController:remover", "produtoController.remover");
$router->post("/removerVariante", "produtoController:removerVariante", "produtoController.removerVariante");
$router->post("/removerImagem", "produtoController:removerImagem", "produtoController.removerImagem");

$router->get("/editar/{codigo}", "produtoController:editar", "produtoController.editar");
$router->post("/atualizar", "produtoController:atualizar", "produtoController.atualizar");


$router->dispatch();

if($router->error()){
    $router->redirect("/error/{$router->error()}");
}
