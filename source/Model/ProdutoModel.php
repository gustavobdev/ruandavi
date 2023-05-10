<?php


namespace Source\Model;

use PDO;

class ProdutoModel
{

    public function __construct()
    {
        global $db;
        $this->db=$db;
    }

    public function cadastraProduto($nomeVl, $skuVl, $descricaoVl, $estoqueVl, $precoVl)
    {
        try {
            $query = $this->db->prepare("
                    INSERT INTO produto (nome,sku,descricao,estoque,preco) VALUE (:nome,:sku,:descricao,:estoque,:preco);
            ");

            $query->execute(array(
                ':nome' => $nomeVl,
                ':sku' => $skuVl,
                ':descricao' => $descricaoVl,
                ':estoque' => $estoqueVl,
                ':preco' => $precoVl
            ));

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => $this->db->lastInsertId());
            } else {
                return array("erro" => true, "data" => "Algo deu errado ao tentar cadastrar o produto!");
            }
        } catch (PDOException $e) {
            echo 'Erro ao insert: ' . $e->getMessage();
        }

    }
    public function atualizaProduto($id, $nomeVl, $skuVl, $descricaoVl, $estoqueVl, $precoVl)
    {
        try {
            $query = $this->db->prepare("
                    UPDATE produto SET nome = :nome,sku = :sku,descricao = :descricao,estoque = :estoque,preco = :preco WHERE id = :id;
            ");

            $query->execute(array(
                ':id' => $id,
                ':nome' => $nomeVl,
                ':sku' => $skuVl,
                ':descricao' => $descricaoVl,
                ':estoque' => $estoqueVl,
                ':preco' => $precoVl
            ));

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => '');
            } else {
                return array("erro" => true, "data" => "Algo deu errado ao tentar atualizar o produto!");
            }
        } catch (PDOException $e) {
            echo 'Erro ao insert: ' . $e->getMessage();
        }

    }
    public function cadastraImagem($idProduto, $caminho)
    {
        try {
            $query = $this->db->prepare("
                    INSERT INTO imagem (id_produto, caminho) VALUE (:idProduto,:caminho);
            ");

            $query->execute(array(
                ':idProduto' => $idProduto,
                ':caminho' => $caminho
            ));

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => $this->db->lastInsertId());
            } else {
                return array("erro" => true, "data" => "Algo deu errado ao tentar cadastrar o produto!");
            }
        } catch (PDOException $e) {
            echo 'Erro ao insert: ' . $e->getMessage();
        }
    }
    public function cadastraVariante($idProduto, $idTipoVariacao, $descricao)
    {
        try {
            $query = $this->db->prepare("
                    INSERT INTO variacao (id_produto, id_tipo_variacao, descricao) VALUE (:idProduto,:idTipoVariacao, :descricao);
            ");

            $query->execute(array(
                ':idProduto' => $idProduto,
                ':idTipoVariacao' => $idTipoVariacao,
                ':descricao' => $descricao
            ));

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => $this->db->lastInsertId());
            } else {
                return array("erro" => true, "data" => "Algo deu errado ao tentar cadastrar o produto!");
            }
        } catch (PDOException $e) {
            echo 'Erro ao insert: ' . $e->getMessage();
        }
    }
    public function apagaProduto($idProduto)
    {
        try {
            $query = $this->db->prepare("
                    UPDATE produto SET situacao = 2 WHERE id = :idProduto;
                    UPDATE imagem SET situacao = 2 WHERE id_produto = :idProduto;
                    UPDATE variacao SET situacao = 2 WHERE id_produto = :idProduto;
            ");

            $query->execute(array(
                ':idProduto' => $idProduto
            ));

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => "Produto apagado com sucesso!");
            } else {
                return array("erro" => true, "data" => "Algo deu errado ao tentar apagar o produto!");
            }
        } catch (PDOException $e) {
            echo 'Erro ao insert: ' . $e->getMessage();
        }
    }
    public function listaProdutos(){

        try {
            $query = $this->db->prepare(" 
                SELECT 
                    id, nome, sku, descricao, estoque, preco,  
                    concat('[', ( SELECT group_concat(JSON_OBJECT('caminho', caminho)) FROM imagem WHERE id_produto = p.id AND situacao = 0  ),']') as imagens,
                    concat('[',( SELECT group_concat(JSON_OBJECT('descricao', v.descricao,'tipo', tv.nome)) FROM variacao v INNER JOIN  tipo_variacao tv ON v.id_tipo_variacao = tv.id AND v.situacao = 0 WHERE id_produto = p.id AND v.situacao = 0  ),']') as variantes
                    FROM produto p WHERE situacao = 0           
            ");
            $query->execute();

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => $query->fetchall(PDO::FETCH_ASSOC));
            } else {
                return array("erro" => true, "data" =>"Nenhum produto encontrado");
            }
        } catch (PDOException $e) {
            echo 'Erro na pesquisa: ' . $e->getMessage();
        }
    }
    public function listaProduto($idProduto){

        try {
            $query = $this->db->prepare(" 
                SELECT 
                    id, nome, sku, descricao, estoque, preco,  
                    concat('[', ( SELECT group_concat(JSON_OBJECT('caminho', caminho, 'idImagem', id)) FROM imagem WHERE id_produto = p.id AND situacao = 0),']') as imagens,
                    concat('[',( SELECT group_concat(JSON_OBJECT('descricao', v.descricao,'idVariante', v.id,'tipo', tv.nome)) FROM variacao v INNER JOIN  tipo_variacao tv ON v.id_tipo_variacao = tv.id AND v.situacao = 0 WHERE id_produto = p.id AND v.situacao = 0),']') as variantes
                    FROM produto p WHERE situacao = 0 AND id = :idProduto          
            ");
            $query->execute(array(":idProduto"=>$idProduto));

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => $query->fetchall(PDO::FETCH_ASSOC));
            } else {
                return array("erro" => true, "data" =>"Nenhum produto encontrado");
            }
        } catch (PDOException $e) {
            echo 'Erro na pesquisa: ' . $e->getMessage();
        }
    }

    public function removeVariante($idVariante){

        try {
            $query = $this->db->prepare(" 
                UPDATE variacao SET situacao = 2 WHERE id = :idVariante;    
            ");
            $query->execute(array(":idVariante"=>$idVariante));

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => $query->fetchall(PDO::FETCH_ASSOC));
            } else {
                return array("erro" => true, "data" =>"Erro ao tenta excluir a variante");
            }
        } catch (PDOException $e) {
            echo 'Erro na pesquisa: ' . $e->getMessage();
        }
    }
    public function removeImagem($idImagem){

        try {
            $query = $this->db->prepare(" 
                UPDATE imagem SET situacao = 2 WHERE id = :idImagem;    
            ");
            $query->execute(array(":idImagem"=>$idImagem));

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => $query->fetchall(PDO::FETCH_ASSOC));
            } else {
                return array("erro" => true, "data" =>"Erro ao tenta excluir a imagem");
            }
        } catch (PDOException $e) {
            echo 'Erro na pesquisa: ' . $e->getMessage();
        }
    }
    public function obtemImagensProdutos($idProduto){

        try {
            $query = $this->db->prepare(" 
                SELECT caminho FROM imagem WHERE id_produto = :idProduto      
            ");
            $query->execute(array( ':idProduto' => $idProduto));

            if ($query->rowCount() > 0) {
                return array("erro" => false, "data" => $query->fetchall(PDO::FETCH_ASSOC));
            } else {
                return array("erro" => true, "data" =>"Nenhuma imagem encontrada");
            }
        } catch (PDOException $e) {
            echo 'Erro na pesquisa: ' . $e->getMessage();
        }
    }
}