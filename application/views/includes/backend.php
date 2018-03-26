<!doctype html>
<html lang="en">

<!-- Mirrored from new.uouapps.com/quick-finder/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:12 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Servicios-Administración</title>

    <!-- Stylesheets -->
    <!--    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700%7CDroid+Serif:300,400,700,400italic">-->
    <!--    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>-->
    <?php echo link_tag("/resources/ajax/libs/select2/4.0.0/css/select2.min.css") ?>
    <?php echo link_tag("/resources/css/owl.carousel.css") ?>
    <?php echo link_tag("/resources/css/services.css") ?>
    <?php echo link_tag("/resources/css/font-awesome.css") ?>
    <?php echo link_tag("/resources/css/style.css") ?>
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
                <? //=site_url("/resources/img/flags/32/ES.png") ?><!--" alt=""> ES</a>-->
                <!---->
                <!--                    <ul>-->
                <!--                        <li><a href="#"><img src="-->
                <? //=site_url("/resources/img/flags/32/PT.png") ?><!--" alt=""> PT</a></li>-->
                <!--                        <li><a href="#"><img src="-->
                <? //=site_url("/resources/img/flags/32/FR.png") ?><!--" alt=""> FR</a></li>-->
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

    <div class="homepage-banner has-bg-image" data-bg-image="<?= site_url("/resources/img/homepage-banner.jpg") ?>">

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="block-title">Servicios</h1>
                    <p class="block-secondary-title invert">Administraci&oacute;n</p>
                </div>
                <div class="col-md-12">
                    <form id="filter" action="<?= site_url('api/filter'); ?>" method="post">
                        <div class="map-search">
                            <!--                        <div class="map-toggleButton">-->
                            <!--                            <i class="fa fa-bars" title="Aplicar filtro"></i>-->
                            <!--                        </div>-->
                            <div class="map-search-fields">
                                <div class="field custom-select-box">
                                    <select name="cities[]" class="custom-select" id="cities2" multiple="true"
                                            data-placeholder="Ciudades">
                                    </select>
                                </div>
                                <!--                            <div class="field">-->
                                <!--                                <i class="fa fa-map-marker"></i>-->
                                <!--                                <input type="text" placeholder="Location" class="location">-->
                                <!--                            </div>-->
                                <div class="field custom-select-box">
                                    <select name="distance" class="custom-select"
                                            data-placeholder="Distancia" id="distancia">
                                        <option value="5">5 Km</option>
                                        <option value="10">10 Km</option>
                                        <option value="15">15 Km</option>
                                        <option value="20">20 Km</option>
                                        <option value="25">25 Km</option>
                                    </select>
                                </div>
                                <div class="field custom-select-box">
                                    <select name="categories[]" class="custom-select" multiple="true"
                                            data-placeholder="Categorias" id="categories">
                                    </select>
                                </div>
                            </div>
                            <div class="search-button">
                                <button type="submit" class="btn btn-medium btn-primary" title="Buscar"><i
                                            class="fa fa-search"></i> <i class="fa fa-spinner fa-pulse hide"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="advanced-search">
                        <!--<div class="close">
                            <i class="fa fa-check"></i>
                        </div>-->
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="search-category">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <label>Costo</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-sm-9">
                                                <div class="slider-range-container">
                                                    <div class="slider-range" data-min="1" data-max="10000"
                                                         data-step="2" data-default-min="500" data-default-max="8000"
                                                         data-currency="$"></div>
                                                    <div class="clearfix">
                                                        <input type="text" class="range-from" value="1">
                                                        <input type="text" class="range-to" value="60">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-category">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <label>Rating</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <div class="slider-range-container">
                                                    <div class="slider-range" data-min="1" data-max="6" data-step="1"
                                                         data-default-min="1" data-default-max="6"
                                                         data-currency=" &nbsp; "></div>
                                                    <div class="clearfix">
                                                        <input type="text" class="range-from" value="1">
                                                        <input type="text" class="range-to" value="6">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-category">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <label>D&iacute;as publicados</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <div class="slider-range-container">
                                                    <div class="slider-range" data-min="1" data-max="30" data-step="1"
                                                         data-default-min="4" data-default-max="10"
                                                         data-currency=" &nbsp; "></div>
                                                    <div class="clearfix">
                                                        <input type="text" class="range-from" value="2">
                                                        <input type="text" class="range-to" value="30">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-category">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <label>Lugar</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <input type="text" placeholder="Switzerland">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-category">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <label>Palabras claves</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <input type="text" placeholder="Freelance">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-category">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-3">
                                                <label>Industria</label>
                                            </div>
                                            <div class="col-md-9 col-sm-9">
                                                <div class="custom-select-box">
                                                    <select name="industry" class="custom-select">
                                                        <option value="0">IT</option>
                                                        <option value="1">Hobby</option>
                                                        <option value="2">Sport</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="listing-objects has-bg-image" data-bg-color="f5f5f5">
        <div class="container">
            <div id="filterresult" class="listing listing-3 listing-variation hide">
                <h5>Resultados de b&uacute;squeda</h5>
                <div class="container">
                    <div id="filterresultcontent" class="row">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="uou-tabs">
                        <ul class="tabs">
                            <li class="active"><a href="#uou-tab-2">Categorias</a></li>
                            <li><a href="#uou-tab-3">Ciudades</a></li>
                        </ul>

                        <div class="content">


                            <div class="active" id="uou-tab-2">
                                <div class="row">
                                    <div id="listado_categoria"></div>

                                </div>
                            </div>

                            <div id="uou-tab-3">
                                <br>
                                <div id="listado_ciudades">

                                </div>

                            </div>

                        </div>
                    </div> <!-- end .uou-tabs -->
                </div>
                <div class="col-md-3">
                    <div class="sidebar-listing">
                        <h5 class="sidebar-listing-title">Visitados recientemente</h5>
                        <?php if (count($lastvisited)) : ?>
                            <?php foreach ($lastvisited as $object) : ?>
                                <div class="listing-offer">
                                    <h6 class="title"><a
                                                href="<?= site_url('admin/services/show/') . $object->id ?>"><?= $object->title ?></a>
                                    </h6>
                                    <div class="listing-offer-thumbnail">
                                        <?php if (count($object->getImages()->toArray()) > 0) { ?>
                                            <img src="<?= $object->getImages()->toArray()[0]->getTitle() ?>" alt="">
                                        <?php } ?>
                                    </div>
                                    <div class="listing-offer-content">
                                        <?php if ($object->address) : ?>
                                            <span class="location"><i
                                                        class="fa fa-map-marker"></i> <?= $object->address ?></span>
                                        <?php endif; ?>
                                        <ul class="rate">
                                            <?php $rate = $object->getGlobalrate();
                                            for ($pos = 0; $pos < 10; $pos++) {
                                                if ($pos < $rate) {
                                                    echo '<li><i class="fa fa-star"></i></li>';
                                                } else {
                                                    echo ' <li><i class="fa fa-star-o"></i></li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <?php if ($object->visits) : ?>
                                            <span class="count"><?= $object->visits ?> visitas</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about about-section has-bg-image" data-bg-image="<?= site_url("/resources/img/about-bg.jpg") ?>">
        <div class="triangle"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="section-title text-center">About The Company</h4>
                    <div class="uou-tabs vertical">
                        <ul class="tabs">
                            <li class="active"><a href="#uou-tab-1v">About Us</a></li>
                            <li><a href="#uou-tab-2v">Our Team</a></li>
                            <li><a href="#uou-tab-3v">Our Services</a></li>
                        </ul>

                        <div class="content">
                            <div class="active" id="uou-tab-1v">
                                <div class="col-md-5">
                                    <img src="<?= site_url("/resources/img/about-thumbnail.png") ?>" alt=""
                                         class="img-responsive">
                                </div>
                                <div class="col-md-7">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa in placeat
                                        voluptates omnis vel quod maiores perferendis, eaque quasi expedita, adipisci
                                        dolorum porro itaque quia nesciunt atque earum consequatur ex.</p>
                                    <ul class="list-unstyled mb0">
                                        <li>
                                            <i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span>
                                        </li>
                                        <li><i class="fa fa-angle-right"></i><span>Mauris in erat justo.</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div id="uou-tab-2v">
                                <div class="col-md-5">
                                    <img src="<?= site_url("/resources/img/about-thumbnail.png") ?>" alt=""
                                         class="img-responsive">
                                </div>
                                <div class="col-md-7">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa in placeat
                                        voluptates omnis vel ddquod maiores perferendis, eaque quasi expedita, adipisci
                                        dolorum porro itaque quia nesciunt atque earum consequatur ex.</p>
                                    <ul class="list-unstyled mb0">
                                        <li>
                                            <i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span>
                                        </li>
                                        <li><i class="fa fa-angle-right"></i><span>Mauris in erat justo.</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div id="uou-tab-3v">
                                <div class="col-md-5">
                                    <img src="<?= site_url("/resources/img/about-thumbnail.png") ?>" alt=""
                                         class="img-responsive">
                                </div>
                                <div class="col-md-7">
                                    <p>Lorem ipsuddm dolor sit amet, consectetur adipisicing elit. Ipsa in placeat
                                        voluptates omnis vel quod maiores perferendis, eaque quasi expedita, adipisci
                                        dolorum porro itaque quia nesciunt atque earum consequatur ex.</p>
                                    <ul class="list-unstyled mb0">
                                        <li>
                                            <i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span>
                                        </li>
                                        <li>
                                            <i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span>
                                        </li>
                                        <li><i class="fa fa-angle-right"></i><span>Mauris in erat justo.</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end .uou-tabs -->
                </div>
            </div>
        </div>
    </div>

    <div class="popular_listings">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">Servicios m&aacute;s populares</h3>
                    <div class="header-listing">
                        <h6>Ordernar por</h6>
                        <div class="custom-select-box">
                            <select name="order" class="custom-select">
                                <option value="moreVisits">M&aacute;s visitados</option>
                                <option value="mostRecent">M&aacute;s recientes</option>
                                <option value="bestRated">Mejores evaluados</option>
                            </select>
                        </div>
                    </div>
                    <div class="listing listing-3">
                        <div class="row">
                            <?php if (count($mostvisited)) : ?>
                                <?php foreach ($mostvisited as $object) : ?>
                                    <div class="col-md-4 item">
                                        <div class="listing-grid listing-grid-1">
                                            <div class="listing-heading">
                                                <?php if ($object->professional == 1) { ?>
                                                    <div class="marker-ribbon">
                                                        <div class="ribbon-banner">
                                                            <div class="ribbon-text">Profesional</div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <h5>
                                                    <a href="<?= site_url('admin/services/show/') . $object->id ?>"><?= $object->title ?></a>
                                                </h5>
                                            </div>
                                            <div class="listing-inner">
                                                <div class="flexslider default-slider">
                                                    <ul class="slides">
                                                        <li class="flex-active-slide"
                                                            style="width: 100%; float: left; margin-right: -100%; position: relative; opacity:1; display: block; z-index: 2;">
                                                            <img src="<?= $object->icon ?>" alt="" draggable="false">
                                                        </li>
                                                        <?php
                                                        $images = $object->getImages()->toArray();
                                                        foreach ($images as $image) {
                                                            echo '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="' . $image->getTitle() . '" alt="" draggable="false"></li>';
                                                        }
                                                        ?>
                                                    </ul>
                                                    <div class="reviews">
                                                        <ul>
                                                            <?php $rate = $object->getGlobalrate();

                                                            for ($pos = 0; $pos < 10; $pos++) {
                                                                if ($pos < $rate) {
                                                                    echo '<li><i class="fa fa-star "></i></li>';
                                                                } else {
                                                                    echo ' <li><i class="fa fa-star-o"></i></li>';
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                        <span class="count"><?= $object->getReviews() ?> reviews</span>
                                                    </div>
                                                </div>
                                                <ul class="uou-accordions">
                                                    <li class="">
                                                        <a href="#"><i class="fa fa-user main-icon"></i> Información</a>
                                                        <div>
                                                            <h5 class="title"><?= $object->subtitle ?></h5>
                                                            <p><?= $object->description ?></p>
                                                        </div>
                                                    </li>
                                                    <li class="active">

                                                        <a href="#"><i class="fa fa-envelope main-icon"></i> Información adicional</a>
                                                        <div>
                                                            <ul class="contact-info list-unstyled mb0">

                                                                <?php if ($object->address) { ?>
                                                                    <li><i class="fa fa-map-marker"></i> <?= $object->address ?></li><?php } ?>
                                                                <?php if ($object->email) { ?>
                                                                    <li><i class="fa fa-envelope-o"></i> <?= $object->email ?></li><?php } ?>
                                                                <?php if ($object->url) { ?>
                                                                    <li><i class="fa fa-globe"></i><?= $object->url ?></li><?php } ?>
                                                                <?php if ($object->phone) { ?>
                                                                    <li><i class="fa fa-phone"></i><?= $object->phone ?></li><?php } ?>
                                                                <?php if ($object->other_phone) { ?>
                                                                    <li><i class="fa fa-fax"></i> <?= $object->other_phone ?></li> <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul> <!-- end .uou-accordions -->
                                                <div class="info-footer">
                                                    <img height="20" width="20" src="<?= $object->getSubcategories()->toArray()[0]->getIcon() ?>">
                                                    <h6><?= $object->getSubcategories()->toArray()[0]->getTitle() ?></h6>
                                                    <a class="pull-right pl10" title="Destruir"
                                                       href="<?= site_url('admin/services/destroy/') . $object->id ?>"><i
                                                                class="fa fa-trash bookmark"></i></a>
                                                    <a class="pull-right pl10" title="Editar"
                                                       href="<?= site_url('admin/services/edit/') . $object->id ?>"><i
                                                                class="fa fa-edit bookmark"></i></a>
                                                    <a class="pull-right" title="Ver"
                                                       href="<?= site_url('admin/services/show/') . $object->id ?>"><i
                                                                class="fa fa-eye bookmark"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="loading_popular_listings hide">
                                <p class="text-center" style="padding: 100px 0"><i class="fa fa-spinner fa-pulse"></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="toggle-button text-center">
                        <button class="btn btn-medium btn-primary">View All listings</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sponsors sponsors-2 has-bg-image" data-bg-image="<?= site_url("/resources/img/banner-mission.jpg") ?>"
         data-bg-color="00D793" data-bg-opacity=".20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">Our Sponsors</h3>
                    <div class="sponsors-slider">
                        <div class="item"><img src="<?= site_url("/resources/img/sponsor_logo1_1.png") ?>" alt=""
                                               class="img-responsive"></div>
                        <div class="item"><img src="<?= site_url("/resources/img/sponsor_logo2_2.png") ?>" alt=""
                                               class="img-responsive"></div>
                        <div class="item"><img src="<?= site_url("/resources/img/sponsor_logo3_3.png") ?>" alt=""
                                               class="img-responsive"></div>
                        <div class="item"><img src="<?= site_url("/resources/img/sponsor_logo4_4.png") ?>" alt=""
                                               class="img-responsive"></div>
                        <div class="item"><img src="<?= site_url("/resources/img/sponsor_logo5_5.png") ?>" alt=""
                                               class="img-responsive"></div>
                        <div class="item"><img src="<?= site_url("/resources/img/sponsor_logo6_6.png") ?>" alt=""
                                               class="img-responsive"></div>
                        <div class="item"><img src="<?= site_url("/resources/img/sponsor_logo4_4.png") ?>" alt=""
                                               class="img-responsive"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="uou-block-4e has-bg-image" data-bg-color="ffffff">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#" class="logo"><img src="<?= site_url("/resources/img/logo.png") ?>" alt=""></a>

                    <ul style="background-image: url(<?= site_url("/resources/img/footer-map-bg.png") ?>);"
                        class="contact-info has-bg-image contain"
                        data-bg-image="<?= site_url("/resources/img/footer-map-bg.png") ?>">
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <address>795 Folsom Ave, Suite 600, San Francisco, CA 94107</address>
                        </li>

                        <li>
                            <i class="fa fa-phone"></i>
                            <a href="tel:#">(123) 456-7890</a>
                        </li>

                        <li>
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:#">first.last@example.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6">
                    <h5>Twitter Feed</h5>

                    <ul class="twitter-feed">
                        <li>
                            RT <a href="#">@no1son</a>: Now this <a href="#">http://t.co/TSfMW1qMAW</a> is one hell of a
                            stunning site!!! Awesome work guys <a href="#">@AIRNAUTS</a>
                            <a href="#" class="time">May 25</a>
                        </li>

                        <li>
                            Check out the wordpress version of Tucson - <a href="#">http://t.co/sBlU3GbapT</a>
                            <a href="#" class="time">May 22</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6">
                    <h5>Photostream</h5>

                    <ul class="photos-list">
                        <li><img src="<?= site_url("/resources/img/photostream4.jpg") ?>" alt=""></li>
                        <li><img src="<?= site_url("/resources/img/photostream6.jpg") ?>" alt=""></li>
                        <li><img src="<?= site_url("/resources/img/photostream3.jpg") ?>" alt=""></li>
                        <li><img src="<?= site_url("/resources/img/photostream2.jpg") ?>" alt=""></li>
                        <li><img src="<?= site_url("/resources/img/photostream1.jpg") ?>" alt=""></li>
                        <li><img src="<?= site_url("/resources/img/photostream.jpg") ?>" alt=""></li>
                    </ul>
                </div>

                <div class="col-md-3 col-sm-6">
                    <h5>Newsletter</h5>

                    <p>Subscribe to our newsletter to receive our latest news and updates. We do not spam.</p>

                    <form class="newsletter-form" action="#">
                        <input placeholder="Enter your email address" type="email">
                        <input class="btn btn-primary" value="Subscribe" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="uou-block-4a secondary">
        <div class="container">
            <ul class="social-icons">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
            </ul>

            <p>Copyright © 2015 Quck Finder. All Rights reserved.</p>
        </div>
    </div>
</div>

<div class="uou-block-11a">
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

<script src="<? //=site_url("/resources/js/googlemaplocal.js") ?>"></script>
<script src="<?= site_url("/resources/js/jquery-2.1.3.min.js") ?>"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxooB5CXv3oWSzKldWJzStShRvWE8X1MA"></script>

<script src="<?= site_url("/resources/js/plugins/superfish.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/jquery.ui.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/rangeslider.min.js") ?>"></script>

<script src="<?= site_url("/resources/js/plugins/jquery.flexslider-min.js") ?>"></script>

<script src="<?= site_url("/resources/js/uou-accordions.js") ?>"></script>

<script src="<?= site_url("/resources/js/uou-tabs.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/select2.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/owl.carousel.min.js") ?>"></script>
<!--<script src="--><?//=site_url("/resources/js/gmap3.min.js") ?><!--"></script>-->

<script src="<?= site_url("/resources/js/bootstrap.js") ?>"></script>
<script src="<?= site_url("/resources/js/admin.js") ?>"></script>
<script src="<?= site_url("/resources/js/scripts.js") ?>"></script>

</body>

<!-- Mirrored from new.uouapps.com/quick-finder/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:23 GMT -->
</html>
