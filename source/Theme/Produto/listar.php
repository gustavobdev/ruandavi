<?= $this->layout("layoutHome", [ "sideBar" => $sideBar, "navBar" => $navBar ] ); ?>

<?= $this->start("conteudo") ?>
<div class="container">
    <div class="page-header">
        <h3 class="page-title"> Produtos</h3>
    </div>

    <div class="container">
        <div class="card-deck">

            <?php foreach ( $produtos as $item ): ?>

                <?php  $imagem = json_decode($item['imagens'], true)  ?>

                    <div class="card">
                        <img class="card-img-top" src="<?= url($imagem[0]['caminho']) ?>" alt="<?= $item['nome'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['nome'] ?></h5>
                            <p class="card-text"><b>Descrição: </b><?= $item['descricao'] ?></p>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Estoque
                                    <span class="badge badge-primary badge-pill"><?= $item['estoque'] ?></span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Preço
                                    <span class="badge badge-primary badge-pill">R$ <?= number_format($item['preco'],2,",",".") ?></span>
                                </li>
                                <?php  $variantes = json_decode($item['variantes'], true)  ?>
                                <?php foreach ( $variantes as $variante ): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?= $variante['tipo'] ?>
                                        <span class="badge badge-primary badge-pill"><?= $variante['descricao'] ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <span onclick="editarProduto(<?= $item['id'] ?>)" class="btn btn-success p-2 m-2 c-pointer align-self-center" style="white-space: nowrap; ">Editar</span>
                                <span onclick="apagaProduto(<?= $item['id'] ?>)" class="btn btn-danger p-2 m-2 c-pointer align-self-center" style="white-space: nowrap; ">Apagar</span>
                            </div>
                        </div>
                    </div>

            <?php endforeach; ?>

        </div>
    </div>
</div>

<?= $this->stop() ?>

<?= $this->start("css") ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.12/sweetalert2.css" integrity="sha512-JzSVRb7c802/njMbV97pjo1wuJAE/6v9CvthGTDxiaZij/TFpPQmQPTcdXyUVucsvLtJBT6YwRb5LhVxX3pQHQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

</style>
<?= $this->stop() ?>

<?= $this->start("js") ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.12/sweetalert2.min.js" integrity="sha512-JpOhycb+DyMMZuOw0R67ANro2c7Bis1He1HQ1GfzW0p9P+pUUMV7oh007Ah32W88KjBb2H0bBc7h/zlQb5YAog==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $( document ).ready(function() {

    });

    function apagaProduto(idProduto){
        Swal.fire({
            title: 'Realmente deseja excluir este produto ?',
            showDenyButton: true,
            confirmButtonColor: '#1abc9c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'SIM',
            denyButtonText: 'NÃO',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    url: urlHost("/produto/remover"),
                    method: 'post',
                    data: `idProduto=${idProduto}`,
                    success: function(data){
                        data = JSON.parse(data);

                        if(!data.erro){
                            toastr.success('Produto apagado com sucesso!', '');
                            setTimeout(function (){
                                window.location.reload()
                            }, 200)
                        }else
                            toastr.error(data.data, '');
                    }
                });
            }
        })
    }

    function editarProduto(idProduto){
        window.location.href = urlHost(`produto/editar/${idProduto}`)
    }
</script>
<?= $this->stop() ?>