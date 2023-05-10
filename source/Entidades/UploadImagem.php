<?php

namespace Source\Entidades;
use Source\Model\ProdutoModel;

class UploadImagem
{
    private $idProduto ;
    private $uploadDir = 'assets/produtos/'; // diretório de destino para o upload
    private $tipoPermetidos = ['image/jpeg', 'image/png']; // tipos de arquivo permitidos

    public function __construct( $idProdutoVl)
    {
        $this->uploadDir .= "$idProdutoVl/";
        $this->idProduto = $idProdutoVl;
    }

    public function cadastraImagens($files) {
        $produtoModel = new ProdutoModel();

        $uploadedImages = [];

        foreach ($files['imagens']['tmp_name'] as $index => $tmpName) {
            $fileName = basename($files['imagens']['name'][$index]);
            $fileType = $files['imagens']['type'][$index];
            $fileSize = $files['imagens']['size'][$index];


            // Gera uma string única baseada no timestamp atual
            $nomeUnico = uniqid();
            $extensao = pathinfo($fileName, PATHINFO_EXTENSION);
            $novoNome = $nomeUnico . '.' . $extensao;

            $filePath = $this->uploadDir . $novoNome;

            // Verifica se o tipo de arquivo é permitido
            if (!in_array($fileType, $this->tipoPermetidos)) {
                throw new Exception('Tipo de arquivo não permitido');
            }

            // verifica se a pasta existe
            if (!is_dir($this->uploadDir)) {
                mkdir($this->uploadDir, 0777, true);
            }

            // Move o arquivo para o diretório de destino
            if (move_uploaded_file($tmpName, $filePath)) {
                $imagem = $produtoModel->cadastraImagem(
                    $this->idProduto, $filePath
                );

                $uploadedImages[] = $imagem["erro"] ? "Erro ao cadastrar imagem - $filePath" : "Imagem cadastrada - $filePath";
            } else {
                throw new Exception('Erro ao fazer upload do arquivo');
            }
        }

        return $uploadedImages;
    }

}