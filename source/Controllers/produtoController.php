<?php


namespace Source\Controllers;


use Source\Model\ProdutoModel;
use Source\Core\Core;
use Source\Entidades\Produto;

class produtoController extends Core
{
    public function editar($param)
    {
        $sideBar = $this->view->render("fragments/menu-home/sideBar");
        $navBar = $this->view->render("fragments/menu-home/navBar");

        $idProduto = intval($param['codigo']);
        $lista = new Produto($idProduto);
        $lista = $lista->exibe()["data"][0];

        //APENAS EXCLUIR EXISTEM OU CRIAR UM NOVO "VARIANTE E IMAGEM"

        echo $this->view->render("Produto/atualizar", [ "sideBar" => $sideBar, "navBar" => $navBar, "produto"=>$lista, "idProduto"=>$idProduto ]);
        return 0;
    }
    public function criar()
    {

        $sideBar = $this->view->render("fragments/menu-home/sideBar");
        $navBar = $this->view->render("fragments/menu-home/navBar");

        echo $this->view->render("Produto/criar", [ "sideBar" => $sideBar, "navBar" => $navBar ]);
        return 0;
    }
    public function cadastrar()
    {
       //valida $_POST
       if( strlen($_POST['nome-txt']) > 255 || strlen($_POST['sku-txt']) > 255){
           echo json_encode(['erro'=>true, 'data'=>'Nome ou SKU muito longe']);
       }else{
           $nome = htmlspecialchars($_POST['nome-txt']);
           $sku = htmlspecialchars($_POST['sku-txt']);
           $descricao = htmlspecialchars($_POST['descricao-txt']);
           $estoque = intval($_POST['estoque-vl']);
           $preco = floatval($_POST['preco-vl']);
       }

       //valida $_FILES
        if (!isset($_FILES['imagens']) || $_FILES['imagens']['error'] === UPLOAD_ERR_NO_FILE) {
            echo json_encode(['erro'=>true, 'data'=>'Algo deu errado como as imagens']);
            return 0;
        }

        $variantes = [];

        foreach($_POST as $key => $item){
            if(strpos($key, 'tipo') !== false ||
                strpos($key, 'descVariante') !== false ){

                    $desc[] = $item;

                    if(count($desc) == 2){
                        $variantes[] = [ "tipo"=>$desc[0], "descricao"=> $desc[1] ];
                        $desc = [];
                    }
            }
        }

        if(count($desc) == 2){
            $variantes[] = [ "tipo"=>$desc[0], "descricao"=> $desc[1] ];
        }

       $produto = new Produto (
           null, $nome,  $sku, $descricao, $estoque,  $preco,  $_FILES,  $variantes
       );
       $produto = $produto->criar();


        echo json_encode(['erro'=>$produto['erro'], 'data'=>$produto['data']]);

    }
    public function remover(){
        $idProduto = intval($_POST['idProduto']);
        $produto = new Produto ($idProduto);
        $produto = $produto->remover();
        echo json_encode(['erro'=>$produto['erro'], 'data'=>$produto['data']]);
    }
    public function removerVariante(){
        $idVariante = intval($_POST['idVariante']);
        $produto = new Produto ($idVariante);
        $produto = $produto->removerVariante();
        echo json_encode(['erro'=>$produto['erro'], 'data'=>$produto['data']]);
    }
    public function removerImagem(){
        $idImagem = intval($_POST['idImagem']);
        $produto = new Produto ($idImagem,null,null,null,null, null,null, null, $_POST['caminho']);
        $produto = $produto->removerImagem();
        echo json_encode(['erro'=>$produto['erro'], 'data'=>$produto['data']]);
    }
    public function atualizar(){
        //valida $_POST
        if( strlen($_POST['nome-txt']) > 255 || strlen($_POST['sku-txt']) > 255){
            echo json_encode(['erro'=>true, 'data'=>'Nome ou SKU muito longe']);
        }else{
            $id = intval($_POST['id']);
            $nome = htmlspecialchars($_POST['nome-txt']);
            $sku = htmlspecialchars($_POST['sku-txt']);
            $descricao = htmlspecialchars($_POST['descricao-txt']);
            $estoque = intval($_POST['estoque-vl']);
            $preco = floatval($_POST['preco-vl']);
        }

        $variantes = [];

        foreach($_POST as $key => $item){
            if(strpos($key, 'tipo') !== false ||
                strpos($key, 'descVariante') !== false ){

                $desc[] = $item;

                if(count($desc) == 2){
                    $variantes[] = [ "tipo"=>$desc[0], "descricao"=> $desc[1] ];
                    $desc = [];
                }
            }
        }

        if(count($desc) == 2){
            $variantes[] = [ "tipo"=>$desc[0], "descricao"=> $desc[1] ];
        }

        $produto = new Produto (
            $id, $nome,  $sku, $descricao, $estoque,  $preco,  $_FILES,  $variantes
        );
        $produto = $produto->atualizar();


        echo json_encode(['erro'=>$produto['erro'], 'data'=>$produto['data']]);
    }
}
