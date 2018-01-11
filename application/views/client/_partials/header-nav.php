<div class="header-nav">
    <div class="box-shadow-for-ui">

        <div class="uou-block-2b icons">
            <div class="container">
                <a href="#" class="logo"><img src="<?= site_url("/resources/img/logo.png") ?>" alt=""></a>
                <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>

                <nav class="nav">
                    <ul class="sf-menu">
                        <li class="<?= $tab == "home" ? "active" : "" ?>">
                            <a href="<?= site_url("index") ?>"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="<?= $tab == "myservices" ? "active" : "" ?>">
                            <a href="<?= site_url("myservices") ?>"><i class="fa fa-bullhorn"></i>Mis
                                Servicios
                            </a>
                            <ul class="demo-menu">
                                <li><a href="<?=site_url("createservice") ?>">Crear Anuncio</a></li>
                            </ul>
                        </li>
                        <li class="<?= $tab == "mysearchs" ? "active" : "" ?>">
                            <a href="<?= site_url("mysearchs") ?>"><i class="fa fa-search-plus"></i>
                                Mis búsquedas</a>
                        </li>
                        <li class="<?= $tab == "myfavorites" ? "active" : "" ?>">
                            <a href="<?= site_url("myfavorites") ?>"><i class="fa fa-star"></i>
                                Mis favoritos</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div> <!-- end .uou-block-2b -->

    </div>
</div> <!-- edn header-navm -->