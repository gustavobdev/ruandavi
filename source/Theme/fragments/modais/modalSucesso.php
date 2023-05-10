<div class="modal fade" id="modalMensagem" tabindex="-1" role="dialog" aria-labelledby="modalMensagem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-white">
            <div class="modal-body">

                <div class="card text-center">
                        <img src="<?= url('assets/images/success-icon.png') ?>" style="width: 20%; align-self: center;" class="mt-4">
                        <div class="form-group mt-3" id="divMensagem">
                        </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" onclick="$('#modalMensagem').modal('hide')">Fechar</button>
            </div>
        </div>
    </div>
</div>