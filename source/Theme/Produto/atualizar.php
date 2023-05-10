<?= $this->layout("layoutHome", [ "sideBar" => $sideBar, "navBar" => $navBar ] ); ?>

<?= $this->start("conteudo") ?>
<div class="container">
    <div class="page-header">
        <h3 class="page-title"> Novo Produto</h3>
    </div>

    <form class="pt-3 container" id="formProduto">

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="nome-txt">Nome</label>
                <input type="text" class="form-control" placeholder="" id="nome-txt" name="nome-txt" value="<?= $produto['nome'] ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome-txt">SKU</label>
                <input type="text" class="form-control" placeholder="" id="sku-txt" name="sku-txt" value="<?= $produto['sku'] ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="estoque-vl">Estoque</label>
                <input type="number" class="form-control" placeholder="" id="estoque-vl" name="estoque-vl" value="<?= $produto['estoque'] ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="preco-vl">Preço</label>
                <input type="number" class="form-control" placeholder="" id="preco-vl" name="preco-vl" value="<?= $produto['preco'] ?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="sku-txt">Descrição</label>
                <textarea class="form-control" rows="5" cols="33" id="descricao-txt" name="descricao-txt" ><?= $produto['descricao'] ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="image">Selecione as imagens:</label>
            <input type="file" name="imagens[]" id="imagens" name="imagens" multiple accept="image/png,image/jpeg" class="dropify">
        </div><br>


        <p class="text-dark h4">Variantes</p>
        <div class="container" id="divVariantes">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="tipo-0">Tipo</label>
                    <select class="form-control" placeholder="" id="tipo-0" name="tipo-0">
                        <option value="1">Cor</option>
                        <option value="2">Tamanho</option>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="descVariante-0">Descricao</label>
                    <input type="text" class="form-control" placeholder="" id="descVariante-0" name="descVariante-0">
                </div>
                <div class="form-group col-md-2">
                    <div class="d-flex">
                        <span onclick="acaoVariante(this, 0)" class="btn btn-success p-2 m-2 c-pointer align-self-center" style="white-space: nowrap; ">+ Adicionar</span>
                        <span onclick="acaoVariante(this, 1)" class="btn btn-danger p-2 m-2 c-pointer align-self-center" style="white-space: nowrap; ">+ Remover</span>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <p class="text-dark h4">Variantes atuais</p>
        <div class="container" id="divVariantesAntigas">
            <div class="form-row">
                <?php  $variantes = json_decode($produto['variantes'], true)  ?>
                <?php foreach ( $variantes as $variante ): ?>
                    <div class="container row">
                        <div class="form-group col-md-5">
                            <label for="tipo-0">Tipo</label>
                            <p> <?= $variante['tipo'] ?></p>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="descVariante-0">Descricao</label>
                            <p><?= $variante['descricao'] ?></p>
                        </div>
                        <div class="form-group col-md-2">
                            <div class="d-flex">
                                <span onclick="removerVarianteAntiga(this, <?= $variante['idVariante'] ?>)" class="btn btn-danger p-2 m-2 c-pointer align-self-center" style="white-space: nowrap; ">+ Remover</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <p class="text-dark h4">Imagens atuais</p>
        <div class="container" id="divVariantesAntigas">
            <div class="form-row">
                <div class="text-center d-flex" >
                    <?php  $imagens = json_decode($produto['imagens'], true)  ?>
                    <?php foreach ( $imagens as $imagem ): ?>
                        <div class="d-grid m-2">
                            <img src="<?= url($imagem['caminho']) ?>" class="rounded" alt="" style="height: 200px;">
                            <span onclick="removerImagemAntiga(this, <?= $imagem['idImagem'] ?>, '<?= $imagem['caminho'] ?>')" class="btn btn-danger p-2 m-2 c-pointer align-self-center" style="white-space: nowrap; ">+ Remover</span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <p class="btn btn-block btn-success btn-lg font-weight-medium auth-form-btn" id="btnAtualizarProduto">Atualizar</p>
        </div>

    </form>
</div>
<?= $this->stop() ?>

<?= $this->start("css") ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= url("assets/css/dropify.css") ?>" />
    <style>
        label{
            color: black;
        }
    </style>
<?= $this->stop() ?>

<?= $this->start("js") ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?= url("assets/js/dropify.min.js") ?>"></script>
    <script>
        let divVariantes;

        $( document ).ready(function() {
            divVariantes = $("#divVariantes").html();

            $('.dropify').dropify();

            $('#btnAtualizarProduto').on('click', function(){
                atualizaProduto()
            })
        });

        function acaoVariante(item, acao){
            if(acao){
                if($("#divVariantes").find("div.form-row").length > 1){
                    item.parentNode.parentNode.parentNode.remove()
                }
            }else{
                $("#divVariantes").append( divVariantes )

                $($("#divVariantes").find("div.form-row")).each(function(a,b){
                    $($(b).find("input")).each(function(c,inputs){
                        let nameAtual = $(inputs).attr('name').split('-')[0]
                        let idAtual = $(inputs).attr('id').split('-')[0]

                        $(inputs).attr('name', nameAtual+`-${a}`)
                        $(inputs).attr('id', idAtual+`-${a}`)
                    })

                    $($(b).find("select")).each(function(c,selects){
                        let nameAtual = $(selects).attr('name').split('-')[0]
                        let idAtual = $(selects).attr('id').split('-')[0]

                        $(selects).attr('name', nameAtual+`-${a}`)
                        $(selects).attr('id', idAtual+`-${a}`)
                    })
                })
            }
        }

        function atualizaProduto(){
            let valida = true; // true -> tudo certo : false -> campo faltando

            $("#formProduto").find("input").each(function(x,item){
                if(!(item.id.split('-')[0]).includes('imagens')
                    && !(item.id.split('-')[0]).includes('descVariante')) {

                    if (!item.value) {
                        $(item).css("border", "2px solid rgb(240 10 10)");
                        valida = false;
                    } else
                        $(item).css("border", "1px solid rgba(151, 151, 151, 0.3)");
                }
            });

            if(valida){
                const formData = new FormData();
                formData.append('id', <?= $idProduto ?>);

                const serializedForm = $("#formProduto").serializeArray();
                $.each(serializedForm, function(index, field) {
                    formData.append(field.name, field.value);
                });

                // Adiciona as imagens selecionadas ao formulário
                const files = $('input[name="imagens[]"]')[0].files;
                for (let i = 0; i < files.length; i++) {
                    formData.append('imagens[]', files[i]);
                }

                $.ajax({
                    url: urlHost("/produto/atualizar"),
                    method: 'post',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(data){
                        data = JSON.parse(data);

                        if(!data.erro){
                            toastr.success('Produto atualizado com sucesso!', '');
                            limpaCampos();
                        }else
                            toastr.error(data.data, '');
                    }
                });
            }else
                toastr.warning('Preencha todos os campos para cadastrar o produto!', 'Aviso');
        }

        function removerVarianteAntiga(item, idVariante){
            item.parentNode.parentNode.parentNode.remove();
            $.ajax({
                url: urlHost("/produto/removerVariante"),
                method: 'post',
                data: `idVariante=${idVariante}`,
                success: function(data){
                    data = JSON.parse(data);

                    if(!data.erro){
                        toastr.success('Variante apagada com sucesso!', '');
                    }else
                        toastr.error(data.data, '');
                }
            });
        }
        function removerImagemAntiga(item, idImagem, caminho){
            item.parentNode.remove();
            $.ajax({
                url: urlHost("/produto/removerImagem"),
                method: 'post',
                data: `idImagem=${idImagem}&caminho=${caminho}`,
                success: function(data){
                    data = JSON.parse(data);

                    if(!data.erro){
                        toastr.success('Imagem apagada com sucesso!', '');
                    }else
                        toastr.error(data.data, '');
                }
            });
        }
    </script>
<?= $this->stop() ?>