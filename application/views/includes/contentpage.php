<!doctype html>
<html lang="en">

<!-- Mirrored from new.uouapps.com/quick-finder/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:12 GMT -->
<head>
    <?php
    if (!isset($tab)) {
        $tab = "nomtab";
    }
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Losyp-Administración</title>

    <!-- Stylesheets -->
    <!--    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700%7CDroid+Serif:300,400,700,400italic">-->
    <!--    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>-->
    <?php echo link_tag("/resources/ajax/libs/select2/4.0.0/css/select2.min.css") ?>
    <?php echo link_tag("/resources/css/owl.carousel.css") ?>
    <?php echo link_tag("/resources/css/bootstrap.min.css") ?>
    <?php echo link_tag("/resources/css/style.css") ?>
    <?php echo link_tag("/resources/css/services.css") ?>
    <?php echo link_tag("/resources/css/editor.css") ?>
</head>

<body>
<div id="main-wrapper" class="homepage">
    <div class="toolbar">
        <div class="uou-block-1a blog">
            <div class="container">
                <!--                <ul class="quick-nav">-->
                <!--                    <li><a href="about.html">Acerca de</a></li>-->
                <!--                    <li><a href="blog.html">Blog</a></li>-->
                <!--                    <li><a href="contact.html">Contacto</a></li>-->
                <!--                    <li><a href="#">Pol&iacute;ticas</a></li>-->
                <!--                </ul>-->

                <ul class="social">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                </ul>

                <ul class="authentication">
                    <?php if (isset($showlogin) == true) { ?>
                        <li><a href="<?= site_url("admin/auth/login") ?>">Iniciar</a></li>
                        <li><a href="<?= site_url("admin/auth/register") ?>">Registrarse</a></li>
                    <?php } else { ?>
                        <li><a href="<?= site_url("admin/auth/logout") ?>">Salir</a></li>
                    <?php } ?>
                </ul>

                <!--                <div class="language">-->
                <!--                    <a href="#" class="toggle"><img src="-->
                <? //=site_url("/resources/img/flags/32/NL.png") ?><!--" alt=""> NDL</a>-->
                <!---->
                <!--                    <ul>-->
                <!--                        <li><a href="#"><img src="-->
                <? //=site_url("/resources/img/flags/32/PT.png") ?><!--" alt=""> PT</a></li>-->
                <!--                        <li><a href="#"><img src="-->
                <? //=site_url("/resources/img/flags/32/FR.png") ?><!--" alt=""> FR</a></li>-->
                <!--                        <li><a href="#"><img src="-->
                <? //=site_url("/resources/img/flags/32/ES.png") ?><!--" alt=""> ES</a></li>-->
                <!--                    </ul>-->
                <!--                </div>-->
            </div>
        </div> <!-- end .uou-block-1a -->
    </div> <!-- end toolbar -->

    <div class="header-nav">
        <div class="box-shadow-for-ui">

            <div class="uou-block-2b icons">
                <div class="container">
                    <a href="#" class="logo"><img src="<?= site_url("/resources/img/logo.png") ?>" alt=""></a>
                    <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>

                    <nav class="nav">
                        <ul class="sf-menu">
                            <li class="<?= $tab == "home" ? "active" : "" ?>"><a href="<?= site_url("admin/home") ?>"><i
                                            class="fa fa-home"></i> Inicio</a>

                            </li>
                            <li class="<?= $tab == "pagos" ? "active" : "" ?>">
                                <a href="<?= site_url("admin/pagos") ?>"><i class="fa fa-dollar"></i> Pagos</a>
                                <ul class="demo-menu">
                                    <li><a href="<?= site_url("admin/pagos/solicitados") ?>">Pagos solicitados</a></li>
                                    <li><a href="<?= site_url("admin/pagos/activos") ?>">Pagos activos</a></li>
                                    <li><a href="<?= site_url("admin/pagos/expirados") ?>">Pagos expirados</a></li>
                                    <li><a href="<?= site_url("admin/pagos/denegados") ?>">Pagos denegados</a></li>
                                    <li><a href="<?= site_url("admin/pagos/membresias") ?>">Pagos membresias</a></li>
                                </ul>
                            </li>
                            <li class="<?= $tab == "services" ? "active" : "" ?>">
                                <a href="<?= site_url("admin/services") ?>"><i class="fa fa-cogs"></i> Servicios </a>
                                <ul class="demo-menu">
                                    <li><a href="<?= site_url("admin/services/denunciados") ?>">Mostrar Servicios
                                            Denunciados</a></li>

                                    <li><a href="<?= site_url("admin/services") ?>">Mostrar Servicios Existentes</a>
                                    </li>
                                    <li><a href="<?= site_url("admin/services/create") ?>">Crear Servicio</a></li>
                                </ul>
                            </li>
                            <li class="<?= $tab == "category" ? "active" : "" ?>">
                                <a href="<?= site_url("admin/categories") ?>"><i class="fa fa-tag"></i> Categorias</a>
                                <ul class="demo-menu">
                                    <li><a href="<?= site_url("admin/categories") ?>">Mostrar Categorias Existentes</a>
                                    </li>
                                    <li><a href="<?= site_url("admin/categories/create") ?>">Crear Categorias</a></li>
                                </ul>
                            </li>
                            <li class="<?= $tab == "subcategory" ? "active" : "" ?>">
                                <a href="<?= site_url("admin/subcategory") ?>"><i class="fa fa-tags"></i> Sub-Categorias</a>
                                <ul class="demo-menu">
                                    <li><a href="<?= site_url("admin/subcategory") ?>">Mostrar Sub-Categorias
                                            Existentes</a></li>
                                    <li><a href="<?= site_url("admin/subcategory/create") ?>">Crear Sub-Categorias</a>
                                    </li>
                                </ul>

                            <li class="<?= $tab == "cities" ? "active" : "" ?>">
                                <a href="<?= site_url("admin/cities") ?>"><i class="fa fa-map-marker"></i> Ciudades </a>
                                <ul class="demo-menu">
                                    <li><a href="<?= site_url("admin/cities") ?>">Mostrar Ciudades</a></li>
                                    <li><a href="<?= site_url("admin/cities/create") ?>">Agregar Ciudad</a></li>
                                </ul>
                            </li>

                            <li class="<?= $tab == "user" ? "active" : "" ?>">
                                <a href="<?= site_url("admin/users") ?>"><i class="fa fa-user"></i> Usuarios </a>
                                <ul class="demo-menu">
                                    <li><a href="<?= site_url("admin/users") ?>">Mostrar Usuarios</a></li>
                                    <li><a href="<?= site_url("admin/users/create") ?>">Agregar Usuario</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> <!-- end .uou-block-2b -->

        </div>
    </div> <!-- edn header-navm -->

    <!--    <div class="homepage-banner has-bg-image" data-bg-image="-->
    <? //=site_url("/resources/img/homepage-banner.jpg") ?><!--">-->
    <!--        <div class="advanced-search">-->
    <!--            <div class="close">-->
    <!--                <i class="fa fa-close"></i>-->
    <!--            </div>-->
    <!--            <div class="container">-->
    <!--                <div class="row">-->
    <!--                    <div class="col-md-12">-->
    <!--                        <div class="search-category">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-md-3 col-sm-3">-->
    <!--                                    <label>Cost</label>-->
    <!--                                </div>-->
    <!--                                <div class="col-md-9 col-sm-9 col-sm-9">-->
    <!--                                    <div class="slider-range-container">-->
    <!--                                        <div class="slider-range" data-min="1" data-max="10000" data-step="2" data-default-min="500" data-default-max="8000" data-currency="$"></div>-->
    <!--                                        <div class="clearfix">-->
    <!--                                            <input type="text" class="range-from" value="1">-->
    <!--                                            <input type="text" class="range-to" value="60">-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="search-category">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-md-3 col-sm-3">-->
    <!--                                    <label>Rating</label>-->
    <!--                                </div>-->
    <!--                                <div class="col-md-9 col-sm-9">-->
    <!--                                    <div class="slider-range-container">-->
    <!--                                        <div class="slider-range" data-min="1" data-max="6" data-step="1" data-default-min="1" data-default-max="6" data-currency=" &nbsp; "></div>-->
    <!--                                        <div class="clearfix">-->
    <!--                                            <input type="text" class="range-from" value="1">-->
    <!--                                            <input type="text" class="range-to" value="6">-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="search-category">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-md-3 col-sm-3">-->
    <!--                                    <label>Days published</label>-->
    <!--                                </div>-->
    <!--                                <div class="col-md-9 col-sm-9">-->
    <!--                                    <div class="slider-range-container">-->
    <!--                                        <div class="slider-range" data-min="1" data-max="30" data-step="1" data-default-min="4" data-default-max="10" data-currency=" &nbsp; "></div>-->
    <!--                                        <div class="clearfix">-->
    <!--                                            <input type="text" class="range-from" value="2">-->
    <!--                                            <input type="text" class="range-to" value="30">-->
    <!--                                        </div>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="search-category">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-md-3 col-sm-3">-->
    <!--                                    <label>Location</label>-->
    <!--                                </div>-->
    <!--                                <div class="col-md-9 col-sm-9">-->
    <!--                                    <input type="text" placeholder="Switzerland">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="search-category">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-md-3 col-sm-3">-->
    <!--                                    <label>Keywords</label>-->
    <!--                                </div>-->
    <!--                                <div class="col-md-9 col-sm-9">-->
    <!--                                    <input type="text" placeholder="Freelance">-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="search-category">-->
    <!--                            <div class="row">-->
    <!--                                <div class="col-md-3 col-sm-3">-->
    <!--                                    <label>Industry</label>-->
    <!--                                </div>-->
    <!--                                <div class="col-md-9 col-sm-9">-->
    <!--                                    <div class="custom-select-box">-->
    <!--                                        <select name="industry" class="custom-select">-->
    <!--                                            <option value="0">IT</option>-->
    <!--                                            <option value="1">Hobby</option>-->
    <!--                                            <option value="2">Sport</option>-->
    <!--                                        </select>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="container">-->
    <!--            <div class="row">-->
    <!--                <div class="col-md-8 col-md-offset-2">-->
    <!--                    <h3>Looking for something?<br> let us help you.</h3>-->
    <!--                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem ad eius consequatur nulla commodi inventore mollitia esse totam minima error, doloremque placeat deleniti suscipit, ipsam maxime.</p>-->
    <!--                </div>-->
    <!--                <div class="col-md-12">-->
    <!--                    <div class="map-search">-->
    <!--                        <div class="map-toggleButton">-->
    <!--                            <i class="fa fa-bars"></i>-->
    <!--                        </div>-->
    <!--                        <div class="map-search-fields">-->
    <!--                            <div class="field">-->
    <!--                                <input type="text" placeholder="Filter by keyword">-->
    <!--                            </div>-->
    <!--                            <div class="field">-->
    <!--                                <i class="fa fa-map-marker"></i>-->
    <!--                                <input type="text" placeholder="Location" class="location">-->
    <!--                            </div>-->
    <!--                            <div class="field custom-select-box">-->
    <!--                                <select name="categories" class="custom-select">-->
    <!--                                    <option value="0">Categories</option>-->
    <!--                                    <option value="1">Spa</option>-->
    <!--                                    <option value="2">Cinema</option>-->
    <!--                                </select>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="search-button">-->
    <!--                            <button class="btn btn-medium btn-primary">Search business</button>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <div class="subheader subheader-v2 has-bg-image" data-bg-image="<?= site_url("/resources/img/$tab-header.jpg") ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="block-title"><?= $tabTitle ?></h1>
                    <!--                    <p class="block-secondary-title invert">We are driven by our mission</p>-->
                </div>
            </div>
        </div>
    </div>
    <div class="listing-objects" style="background-color: rgb(245, 245, 245)">
        <div class="container">
            <?php if (isset($errors)) { ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error) { ?>
                        <?= $error; ?>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php $this->load->view($content); ?>
        </div>
    </div>
</div>

<div class="uou-block-11a hide">
    <h5 class="title">Menu</h5>
    <a href="#" class="mobile-sidebar-close">&times;</a>
    <nav class="main-nav">
        <ul>
            <li class="<?= $tab == "home" ? "active" : "" ?>"><a href="<?= site_url("admin/home") ?>"><i
                            class="fa fa-home"></i> Inicio</a></li>
            <li class="<?= $tab == "pagos" ? "active" : "" ?>"><a href="<?= site_url("admin/pagos") ?>"><i
                            class="fa fa-dollar"></i> Pagos</a></li>
            <li class="pl10 <?= $tab == "solicitados" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/pagos/solicitados") ?>">Pagos solicitados</a></li>
            <li class="pl10 <?= $tab == "activos" ? "active" : "" ?>"><a href="<?= site_url("admin/pagos/activos") ?>">Pagos
                    activos</a></li>
            <li class="pl10 <?= $tab == "expirados" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/pagos/expirados") ?>">Pagos expirados</a></li>
            <li class="pl10 <?= $tab == "denegados" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/pagos/denegados") ?>">Pagos denegados</a></li>
            <li class="pl10 <?= $tab == "membresias" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/pagos/membresias") ?>">Pagos membres&iacute;as</a></li>

            <li class="<?= $tab == "services" ? "active" : "" ?>"><a href="<?= site_url("admin/services") ?>"><i
                            class="fa fa-cogs"></i> Servicios </a></li>
            <li class="pl10 <?= $tab == "denunciados" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/services/denunciados") ?>">Mostrar Servicios Denunciados</a></li>
            <li class="pl10 <?= $tab == "services" ? "active" : "" ?>"><a href="<?= site_url("admin/services") ?>">Mostrar
                    Servicios Existentes</a></li>
            <li class="pl10 <?= $tab == "crearservicio" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/services/create") ?>">Crear Servicio</a></li>

            <li class="<?= $tab == "category" ? "active" : "" ?>"><a href="<?= site_url("admin/categories") ?>"><i
                            class="fa fa-tag"></i> Categorias</a></li>
            <li class="pl10 <?= $tab == "category" ? "active" : "" ?>"><a href="<?= site_url("admin/categories") ?>">Mostrar
                    Categorias Existentes</a></li>
            <li class="pl10 <?= $tab == "crearcategoria" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/categories/create") ?>">Crear Categorias</a></li>

            <li class="<?= $tab == "subcategory" ? "active" : "" ?>"><a href="<?= site_url("admin/subcategory") ?>"><i
                            class="fa fa-tags"></i> Sub-Categorias</a></li>
            <li class="pl10 <?= $tab == "subcategory" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/subcategory") ?>">Mostrar Sub-Categorias Existentes</a></li>
            <li class="pl10 <?= $tab == "crearsubcategoria" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/subcategory/create") ?>">Crear Sub-Categorias</a></li>

            <li class="<?= $tab == "cities" ? "active" : "" ?>"><a href="<?= site_url("admin/cities") ?>"><i
                            class="fa fa-map-marker"></i> Ciudades </a></li>
            <li class="pl10 <?= $tab == "cities" ? "active" : "" ?>"><a href="<?= site_url("admin/cities") ?>">Mostrar
                    Ciudades</a></li>
            <li class="pl10 <?= $tab == "crearciudad" ? "active" : "" ?>"><a
                        href="<?= site_url("admin/cities/create") ?>">Agregar Ciudad</a></li>

            <li class="<?= $tab == "user" ? "active" : "" ?>"><a href="<?= site_url("admin/users") ?>"><i
                            class="fa fa-map-marker"></i> Usuarios </a></li>
            <li class="pl10 <?= $tab == "user" ? "active" : "" ?>"><a href="<?= site_url("admin/users") ?>">Mostrar
                    Usuarios</a></li>
            <li class="pl10 <?= $tab == "crearuser" ? "active" : "" ?>"><a href="<?= site_url("admin/users/create") ?>">Agregar
                    Usuario</a></li>
        </ul>
    </nav>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary confirm"><i class="fa fa-check"></i> Confirmar</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= site_url("/resources/js/jquery-2.1.3.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/superfish.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/jquery.ui.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/rangeslider.min.js") ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxooB5CXv3oWSzKldWJzStShRvWE8X1MA"></script>

<script src="<?= site_url("/resources/js/plugins/jquery.flexslider-min.js") ?>"></script>

<script src="<?= site_url("/resources/js/uou-accordions.js") ?>"></script>

<script src="<?= site_url("/resources/js/uou-tabs.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/select2.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/owl.carousel.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/gmap3.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/bootstrap.js") ?>"></script>
<script src="<?= site_url("/resources/js/admin.js") ?>"></script>
<script src="<?= site_url("/resources/js/scripts.js") ?>"></script>
<script src="<?= site_url("/resources/js/jquery.validate.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/localization/messages_es.min.js") ?>"></script>

<script src="<?= site_url("/resources/js/bootstrap-notify.min.js") ?>"></script>
<style type="text/css" src="<?=site_url('resources/css/editor.css')?>"></style>
<script src="<?=site_url('resources/js/editor.js')?>">


</script>
<?php if(!empty($this->session->flashdata('item'))):?>
    <?php $msg = $this->session->flashdata('item');?>
    <!--div class="alert <?php echo $msg['class']?>" id="notify-id">
        <a class="close" href="#" data-dismiss="alert">x</a>
        <strong>Información!</strong> <?php //echo $msg['message']?>
    </div-->
    <script>
            $.notify(
                {	// options
                    icon: "<?php echo $msg['icon'];?>",
                    title: "<?php echo $msg['title'];?>",
                    message: '<?php echo $msg['message'];?>',
                    target: '_blank'
                    },
                    {
                        // settings
                        type: '<?php echo $msg['class'];?>'
                    }
            );

    </script>
<?php endif;?>
<script>
    $(document).ready(function(){
        $("#content").Editor();
    });
</script>
</body>

<!-- Mirrored from new.uouapps.com/quick-finder/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:23 GMT -->
</html>
