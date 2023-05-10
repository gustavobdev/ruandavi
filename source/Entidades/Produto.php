<?php

namespace Source\Entidades;
use Source\Entidades\UploadImagem;
use Source\Model\ProdutoModel;

class Produto extends UploadImagem
{
    private $id;
    private $nome;
    private $sku;
    private $descricao;
    private $estoque;
    private $preco;
    private $imagens;
    private $variantes;
    private $caminho;

    // construtor da classe
    public function __construct( $idVl = null,  $nomeVl = null,  $skuVl = null,  $descricaoVl = null,  $estoqueVl = null,  $precoVl = null,  $imagensVl = null,  $variantesVl = null, $caminhoImg = null) {
        $this->id = $idVl;
        $this->nome = $nomeVl;
        $this->sku = $skuVl;
        $this->descricao = $descricaoVl;
        $this->estoque = $estoqueVl;
        $this->preco = $precoVl;
        $this->imagens = $imagensVl;
        $this->variantes = $variantesVl;
        $this->caminho = $caminhoImg;
    }


    //lista todos os produtos
    public function listar(){
        $produtoModel = new ProdutoModel();
        $produtos = $produtoModel->listaProdutos();
        return array("erro" => $produtos["erro"], "data" => $produtos["data"]);
    }
    //lista apenas um produto
    public function exibe(){
        $produtoModel = new ProdutoModel();
        $produtos = $produtoModel->listaProduto($this->id);
        return array("erro" => $produtos["erro"], "data" => $produtos["data"]);
    }
    public function criar(){
        $produtoModel = new ProdutoModel();
        $data = [];

        $cadastro = $produtoModel->cadastraProduto(
            $this->nome,
            $this->sku,
            $this->descricao,
            $this->estoque,
            $this->preco
        );

        //valida INSERT
        if($cadastro["erro"]){
            $data = 'Algo deu errado ao tentar cadastrar o produto no banco (produto)!';
            return array("erro" => true, "data" => $data);
        }else{
            //Obtem ID PRODUTO
            $this->id = $cadastro["data"];

            //CADASTRA VARIANTES E IMAGENS
            foreach($this->variantes as $item){
                $variante = $produtoModel->cadastraVariante($this->id, $item['tipo'], $item['descricao']);
                $data[] = $variante["erro"] ? "Algo deu errado ao tentar cadastrar a variante ($item[tipo] - $item[descricao])" :  "Variante cadastrada ($item[tipo] - $item[descricao])";
            }
            $uploadImagem = new UploadImagem($this->id);
            $imagens = $uploadImagem->cadastraImagens($this->imagens);
            $data[] = $imagens;
        }

        return array("erro" => false, "data" => $data);
    }
    public function remover(){
        $produtoModel = new ProdutoModel();
        $produto = $produtoModel->apagaProduto($this->id);

        //Remomeia imagens
        $imagens = $produtoModel->obtemImagensProdutos($this->id);
        if($imagens["erro"]){
            return array("erro" => $imagens["erro"], "data" => $imagens["data"]);
        }else{
            foreach( $imagens['data'] as $imagem){
                if (file_exists($imagem['caminho'])) {
                    $extensao = pathinfo($imagem['caminho'], PATHINFO_EXTENSION);
                    $nome_novo = str_replace(".$extensao", "-DELETADO.$extensao", $imagem['caminho']);
                    rename($imagem['caminho'], $nome_novo);
                }
            }
        }

        return array("erro" => $produto["erro"], "data" => $produto["data"]);
    }
    public function removerVariante(){
        $produtoModel = new ProdutoModel();
        $variante = $produtoModel->removeVariante($this->id);
        return array("erro" => $variante["erro"], "data" => $variante["data"]);
    }
    public function removerImagem(){
        $produtoModel = new ProdutoModel();
        $imagem = $produtoModel->removeImagem($this->id);

        if (file_exists($this->caminho)) {
            $extensao = pathinfo($this->caminho, PATHINFO_EXTENSION);
            $nome_novo = str_replace(".$extensao", "-DELETADO.$extensao", $this->caminho);
            rename($this->caminho, $nome_novo);
        }

        return array("erro" => $imagem["erro"], "data" => $imagem["data"]);
    }
    public function atualizar(){
        $produtoModel = new ProdutoModel();
        $data = [];

        $atualizacao = $produtoModel->atualizaProduto(
            $this->id,
            $this->nome,
            $this->sku,
            $this->descricao,
            $this->estoque,
            $this->preco
        );

        //valida INSERT
        if($atualizacao["erro"]){
            $data = 'Algo deu errado ao tentar atualizar o produto no banco (produto)!';
            return array("erro" => true, "data" => $data);
        }else{

            //CADASTRA VARIANTES E IMAGENS
            foreach($this->variantes as $item){
                if( $item['descricao'] != '') {
                    $variante = $produtoModel->cadastraVariante($this->id, $item['tipo'], $item['descricao']);
                    $data[] = $variante["erro"] ? "Algo deu errado ao tentar cadastrar a variante ($item[tipo] - $item[descricao])" : "Variante cadastrada ($item[tipo] - $item[descricao])";
                }
            }

            if (isset($_FILES['imagens'])) {
                $uploadImagem = new UploadImagem($this->id);
                $imagens = $uploadImagem->cadastraImagens($this->imagens);
                $data[] = $imagens;
            }
        }

        return array("erro" => false, "data" => $data);
    }

}