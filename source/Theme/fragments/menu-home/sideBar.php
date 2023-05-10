<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?= $home ?>">
            <a class="nav-link" href="<?= url('') ?>">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title"> Produtos</span>
            </a>
        </li>
        <li class="nav-item <?= $home ?>">
            <a class="nav-link" href="<?= url('produto/criar') ?>">
                <span class="icon-bg"><i class="mdi mdi-plus menu-icon"></i></span>
                <span class="menu-title"> Novo Produto</span>
            </a>
        </li>
    </ul>
</nav>