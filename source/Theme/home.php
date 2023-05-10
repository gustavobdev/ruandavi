<?= $this->layout("layoutHome", [ "sideBar" => $sideBar, "navBar" => $navBar ] ); ?>

<?= $this->start("conteudo") ?>

    <div class="page-header">
        <h3 class="page-title"> Assinador </h3>
        <!-- <p>Servidores » Versionamentos</p> -->
    </div>

<?= $this->stop() ?>

<?= $this->start("css") ?>
<?= $this->stop() ?>

<?= $this->start("js") ?>
<?= $this->stop() ?>