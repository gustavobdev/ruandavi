<h4 class="card-title"> <?= $titulo ?> </h4>
<?php if($conteudo): ?>
<div class="media">
    <?php if($imgTp): ?>
        <img src="<?= $imagem ?>" alt="image" />
    <?php else: ?>
        <?= $imagem ?>
    <?php endif; ?>
    <div class="media-body">
        <ul class="list-arrow">
            <li> <b>Departamento:</b> <?= $departamento ?> </li>
            <li> <b>Cargo:</b> <?= $cargo ?>  </li>
            <li> <b>CPF:</b> <?= $cpf ?>  </li>
            <li> <b>Assinatura:</b> <?= $assinatura ?> </li>

            <?php if($emissao): ?>
             <li> <b>Emissão:</b> <?= $emissao ?> </li>
            <?php endif; ?>
        </ul>
        <div class="d-flex justify-content-end mb-3">
            <?php if($registra): ?>
                <button type="button" class="btn btn-dark" data-dismiss="modal" data-toggle="modal" data-target="#modalSenha" onclick="attProfissional(<?= $idPro ?>)">Gerar</button>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endif; ?>

