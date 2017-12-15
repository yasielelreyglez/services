<!doctype html>
<html lang="en">

<!-- Mirrored from new.uouapps.com/quick-finder/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:12 GMT -->
<head>
    <?php
    if(!isset($tab)){
        $tab ="nomtab";
    }
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Quickfinder Homepage Landing ver2</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700%7CDroid+Serif:300,400,700,400italic">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <?php echo link_tag("/resources/ajax/libs/select2/4.0.0/css/select2.min.css") ?>
    <?php echo link_tag("/resources/css/owl.carousel.css") ?>
    <?php echo link_tag("/resources/css/bootstrap.min.css") ?>
    <?php echo link_tag("/resources/css/style.css") ?>


</head>

<body>
<div id="main-wrapper" class="homepage">
    <div class="toolbar">
        <div class="uou-block-1a blog">
            <div class="container">
                <ul class="quick-nav">
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>

                <ul class="social">
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-google-plus"></a></li>
                </ul>

                <ul class="authentication">
                    <?php if(isset($showlogin)==true){?>
                        <li><a href="<?=site_url("admin/auth/login") ?>">Login</a></li>
                        <li><a href="<?=site_url("admin/auth/register") ?>">Register</a></li>
                    <?php }else{?>
                        <li><a href="<?=site_url("admin/auth/logout") ?>">Logout</a></li>
                    <?php } ?>
                </ul>

                <div class="language">
                    <a href="#" class="toggle"><img src="<?=site_url("/resources/img/flags/32/NL.png") ?>" alt=""> NDL</a>

                    <ul>
                        <li><a href="#"><img src="<?=site_url("/resources/img/flags/32/PT.png") ?>" alt=""> PT</a></li>
                        <li><a href="#"><img src="<?=site_url("/resources/img/flags/32/FR.png") ?>" alt=""> FR</a></li>
                        <li><a href="#"><img src="<?=site_url("/resources/img/flags/32/ES.png") ?>" alt=""> ES</a></li>
                    </ul>
                </div>
            </div>
        </div> <!-- end .uou-block-1a -->
    </div> <!-- end toolbar -->

    <div class="header-nav">
        <div class="box-shadow-for-ui">

            <div class="uou-block-2b icons">
                <div class="container">
                    <a href="#" class="logo"><img src="<?=site_url("/resources/img/logo.png") ?>" alt=""></a>
                    <a href="#" class="mobile-sidebar-button mobile-sidebar-toggle"><span></span></a>

                    <nav class="nav">
                        <ul class="sf-menu">
                            <li class="<?=$tab=="home"?"active":""?>"><a href="<?=site_url("admin/home") ?>"><i class="fa fa-home"></i> Home</a>

                            </li>
                            <li class="<?=$tab=="pagos"?"active":""?>">
                                <a href="<?=site_url("admin/pagos") ?>"><i class="fa fa-search-plus"></i> Pagos</a>
                                <ul class="demo-menu">
                                    <li><a href="<?=site_url("admin/pagos/solicitados") ?>">Pagos solicitados</a></li>
                                    <li><a href="<?=site_url("admin/pagos/activos") ?>">Pagos activos</a></li>
                                    <li><a href="<?=site_url("admin/pagos/expirados") ?>">Pagos expirados</a></li>
                                    <li><a href="<?=site_url("admin/pagos/denegados") ?>">Pagos denegados</a></li>
                                    <li><a href="<?=site_url("admin/pagos/membresias") ?>">Pagos membresias</a></li>
                                </ul>
                            </li>
                            <li class="<?=$tab=="services"?"active":""?>">
                                <a href="<?=site_url("admin/services") ?>"><i class="fa fa-search-plus"></i> Servicios </a>
                                <ul class="demo-menu">
                                    <li><a href="<?=site_url("admin/services/denunciados") ?>">Mostrar Servicios Denunciados</a></li>

                                    <li><a href="<?=site_url("admin/services") ?>">Mostrar Servicios Existentes</a></li>
                                    <li><a href="<?=site_url("admin/services/create") ?>">Crear Servicio</a></li>
                                </ul>
                            </li>
                            <li class="<?=$tab=="category"?"active":""?>">
                                <a href="<?=site_url("admin/categories") ?>"><i class="fa fa-search-plus"></i> Categorias</a>
                                <ul class="demo-menu">
                                    <li><a href="<?=site_url("admin/categories") ?>">Mostrar Categorias Existentes</a></li>
                                    <li><a href="<?=site_url("admin/categories/create") ?>">Crear Categorias</a></li>
                                </ul>
                            </li>
                            <li class="<?=$tab=="subcategory"?"active":""?>">
                                <a href="<?=site_url("admin/subcategory") ?>"><i class="fa fa-search-plus"></i> Sub-Categorias</a>
                                <ul class="demo-menu">
                                    <li><a href="<?=site_url("admin/subcategory") ?>">Mostrar Sub-Categorias Existentes</a></li>
                                    <li><a href="<?=site_url("admin/subcategory/create") ?>">Crear Sub-Categorias</a></li>
                                </ul>

                            <li  class="<?=$tab=="cities"?"active":""?>">
                                <a href="<?=site_url("admin/cities") ?>"><i class="fa fa-search-plus"></i> Ciudades </a>
                                <ul class="demo-menu">
                                    <li><a href="<?=site_url("admin/cities") ?>">Mostrar Ciudades</a></li>
                                    <li><a href="<?=site_url("admin/cities/create") ?>">Agregar Ciudad</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> <!-- end .uou-block-2b -->

        </div>
    </div> <!-- edn header-navm -->

<!--    <div class="homepage-banner has-bg-image" data-bg-image="--><?//=site_url("/resources/img/homepage-banner.jpg") ?><!--">-->
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

    <div class="listing-objects">
        <div class="container">
        <?php if(isset($errors)) { ?>
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

<div class="uou-block-11a">
    <h5 class="title">Menu</h5>
    <a href="#" class="mobile-sidebar-close">&times;</a>
    <nav class="main-nav">
        <ul>
            <li class="active"><a href="#">Home</a></li>

            <li class="pl10"><a href="index.html">Home 1</a></li>
            <li class="pl10 active"><a href="index2.html">Home 2</a></li>

            <li class="active"><a href="#">Jobs</a></li>
            <li class="pl10"><a href="index_jobs.html">Jobs Index(Default)</a></li>
            <li class="pl10"><a href="single_job.html">Job Single</a></li>
            <li class="pl10"><a href="profile_company.html">Company Profile</a></li>
            <li class="pl10"><a href="profile_company2.html">Company Profile (2)</a></li>

            <li class="active"><a href="#">Businesses</a></li>
            <li class="pl10"><a href="index_business1.html">Business Index(Default)</a></li>
            <li class="pl10"><a href="index_business2.html">Business Index(2)</a></li>
            <li class="pl10"><a href="index_business3.html">Business Index(3)</a></li>
            <li class="pl10"><a href="index_business4.html">Business Index(4)</a></li>
            <li class="pl10"><a href="index_business5.html">Business Index(5)</a></li>
            <li class="pl10"><a href="single_business.html">Business Single</a></li>

            <li class="active"><a href="#">Restaurants</a></li>
            <li class="p10"><a href="index_restaurant.html">Restaurant Index</a></li>
            <li class="p10"><a href="single_restaurant.html">Restaurant Single</a></li>

            <li class="active"><a href="#">Features</a></li>
            <li class="p10"><a href="box-variation1.html">Box Variation 1</a></li>
            <li class="p10"><a href="box-variation2.html">Box Variation 2</a></li>
            <li class="p10"><a href="box-variation3.html">Box Variation 1</a></li>
            <li class="p10"><a href="gui-kit.html">GUI kit</a></li>

            <li class="active"><a href="about.html"></a></li>
            <li class="active"><a href="blog.html"></a></li>
            <li class="active"><a href="contact.html">Contact</a></li>


        </ul>
    </nav>

    <hr>

</div>

<!-- Scripts -->
<!--<script src="--><?//=site_url("/resources/js/googlemaplocal.js") ?><!--"></script>-->
<script src="<?=site_url("/resources/js/jquery-2.1.3.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/plugins/superfish.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/jquery.ui.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/plugins/rangeslider.min.js") ?>"></script>

<script src="<?=site_url("/resources/js/plugins/jquery.flexslider-min.js") ?>"></script>

<script src="<?=site_url("/resources/js/uou-accordions.js") ?>"></script>

<script src="<?=site_url("/resources/js/uou-tabs.js") ?>"></script>
<script src="<?=site_url("/resources/js/plugins/select2.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/owl.carousel.min.js") ?>"></script>
<!--<script src="--><?//=site_url("/resources/js/gmap3.min.js") ?><!--"></script>-->
<script src="<?=site_url("/resources/js/bootstrap.js") ?>"></script>
<script src="<?=site_url("/resources/js/scripts.js") ?>"></script>

</body>

<!-- Mirrored from new.uouapps.com/quick-finder/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:23 GMT -->
</html>
