<div class="modal fade" id="modalSenha" tabindex="-1" role="dialog" aria-labelledby="modalSenha" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-white">
            <div class="modal-header">
                <h5 class="modal-title" >Cadastrar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" id="formSenha">
                            <div id="divAvisa"></div>
                            <div class="form-group">
                                <label for="txtsenha">Senha Logon</label>
                                <input type="password" class="form-control" id="txtsenhaLogo" name="txtsenhaLogo" placeholder="">
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="txtsenha">Senha</label>
                                <input type="password" class="form-control" id="txtsenha" name="txtsenha" placeholder="" minlength="6"  onKeyUp="verificaForcaSenha();">
                                <div id="statusSenha"></div>
                            </div>
                            <div class="form-group">
                                <label for="txtconfSenha">Confirmar Senha</label>
                                <input type="password" class="form-control" id="txtconfSenha" name="txtconfSenha" placeholder="" minlength="6"  onKeyUp="verificaSenhas();">
                                <div id="infoSenhas"></div>
                            </div>
                            <input type="hidden" class="form-control" id="txtprofissional" name="txtprofissional" placeholder="">
                            <div class="form-check form-check-flat form-check-primary">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" id="checkTermo" name="checkTermo" style="opacity: 1 !important; top: 10% !important;"> Li e aceito o <a href="<?= url('assets/termo.pdf') ?>" target="_blank">Termo de uso</a> <i class="input-helper"></i>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnFecharSn">Fechar</button>
                <button type="button" class="btn btn-dark"  id="btnCadastraSenha" >Salvar</button>
            </div>
        </div>
    </div>
</div>