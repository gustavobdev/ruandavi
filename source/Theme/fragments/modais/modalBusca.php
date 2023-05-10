<div class="modal fade" id="modalBusca" tabindex="-1" role="dialog" aria-labelledby="modalBusca" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Buscar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form id="buscar" class="mr-2">
                    <div class="d-flex justify-content-end mb-3">
                        <input type="text" class="form-control" id="txtemail" name="txtemail" style="width: 20em;border: white;" placeholder="E-mail">
                        <button type="button" class="btn btn-secondary" id="btnPesquisa">
                            <i class="mdi mdi-magnify mr-2" style="cursor: pointer"></i> Pesquisar
                        </button>
                    </div>
                </form>

                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body" id="conteudoPesquisa">

                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>