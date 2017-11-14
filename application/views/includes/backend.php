<!doctype html>
<html lang="en">

<!-- Mirrored from new.uouapps.com/quick-finder/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:12 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Quickfinder Homepage Landing ver2</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700%7CDroid+Serif:300,400,700,400italic">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <?php echo link_tag("/resources/ajax/libs/select2/4.0.0/css/select2.min.css") ?>
    <?php echo link_tag("/resources/css/owl.carousel.css") ?>
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
                    <li><a href="<?=site_url("admin/auth/login") ?>">Login</a></li>
                    <li><a href="<?=site_url("admin/auth/register") ?>">Register</a></li>
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
                            <li class="active"><a href="<?=site_url("admin/home") ?>"><i class="fa fa-home"></i> Home</a>

                            </li>
                            <li>
                                <a href="<?=site_url("admin/categories") ?>"><i class="fa fa-search-plus"></i> Categorias</a>
                                <ul class="demo-menu">
                                    <li><a href="<?=site_url("admin/categories") ?>">Mostrar Categorias Existentes</a></li>
                                    <li><a href="<?=site_url("admin/categories/create") ?>">Crear Categorias</a></li>
                                    <li><a href="profile_company.html">Company Profile</a></li>
                                    <li><a href="profile_company2.html">Company Profile (2)</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="index_business1.html"><i class="fa fa-suitcase"></i> Businesses</a>
                                <ul class="demo-menu">
                                    <li><a href="index_business1.html">Business Index(Default)</a></li>
                                    <li><a href="index_business2.html">Business Index(2)</a></li>
                                    <li><a href="index_business3.html">Business Index(3)</a></li>
                                    <li><a href="index_business4.html">Business Index(4)</a></li>
                                    <li><a href="index_business5.html">Business Index(5)</a></li>
                                    <li><a href="single_business.html">Business Single</a></li>
                                </ul>
                            <li>
                                <a href="index_restaurant.html"><i class="fa fa-cutlery"></i>  Restaurants</a>
                                <ul class="demo-menu">
                                    <li><a href="index_restaurant.html">Restaurant Index</a></li>
                                    <li><a href="single_restaurant.html">Restaurant Single</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-cogs"></i> Features</a>
                                <ul class="demo-menu">
                                    <li><a href="box-variation1.html">Box Variation 1</a></li>
                                    <li><a href="box-variation2.html">Box Variation 2</a></li>
                                    <li><a href="box-variation3.html">Box Variation 3</a></li>
                                    <li><a href="gui-kit.html">GUI kit</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div> <!-- end .uou-block-2b -->

        </div>
    </div> <!-- edn header-navm -->

    <div class="homepage-banner has-bg-image" data-bg-image="<?=site_url("/resources/img/homepage-banner.jpg") ?>">
        <div class="advanced-search">
            <div class="close">
                <i class="fa fa-close"></i>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search-category">
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <label>Cost</label>
                                </div>
                                <div class="col-md-9 col-sm-9 col-sm-9">
                                    <div class="slider-range-container">
                                        <div class="slider-range" data-min="1" data-max="10000" data-step="2" data-default-min="500" data-default-max="8000" data-currency="$"></div>
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
                                        <div class="slider-range" data-min="1" data-max="6" data-step="1" data-default-min="1" data-default-max="6" data-currency=" &nbsp; "></div>
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
                                    <label>Days published</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <div class="slider-range-container">
                                        <div class="slider-range" data-min="1" data-max="30" data-step="1" data-default-min="4" data-default-max="10" data-currency=" &nbsp; "></div>
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
                                    <label>Location</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" placeholder="Switzerland">
                                </div>
                            </div>
                        </div>
                        <div class="search-category">
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <label>Keywords</label>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" placeholder="Freelance">
                                </div>
                            </div>
                        </div>
                        <div class="search-category">
                            <div class="row">
                                <div class="col-md-3 col-sm-3">
                                    <label>Industry</label>
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
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h3>Looking for something?<br> let us help you.</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem ad eius consequatur nulla commodi inventore mollitia esse totam minima error, doloremque placeat deleniti suscipit, ipsam maxime.</p>
                </div>
                <div class="col-md-12">
                    <div class="map-search">
                        <div class="map-toggleButton">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="map-search-fields">
                            <div class="field">
                                <input type="text" placeholder="Filter by keyword">
                            </div>
                            <div class="field">
                                <i class="fa fa-map-marker"></i>
                                <input type="text" placeholder="Location" class="location">
                            </div>
                            <div class="field custom-select-box">
                                <select name="categories" class="custom-select">
                                    <option value="0">Categories</option>
                                    <option value="1">Spa</option>
                                    <option value="2">Cinema</option>
                                </select>
                            </div>
                        </div>
                        <div class="search-button">
                            <button class="btn btn-medium btn-primary">Search business</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="listing-objects has-bg-image" data-bg-color="f5f5f5">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="uou-tabs">
                        <ul class="tabs">
                            <li class="active"><a href="#uou-tab-1">Map</a></li>
                            <li><a href="#uou-tab-2">Industry</a></li>
                            <li><a href="#uou-tab-3">Type</a></li>
                            <li><a href="#uou-tab-4">Country</a></li>
                        </ul>

                        <div class="content">
                            <div class="active" id="uou-tab-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="map">
                                                <div id="map-top"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="locations-list list-unstyled mb0">
                                            <li><a href="#"><i class="fa fa-angle-right"></i>Australia & New Zeland <span class="count">(5)</span></a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i>Northern America <span class="count">(5)</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="locations-list list-unstyled mb0">
                                            <li><a href="#"><i class="fa fa-angle-right"></i>Southern Asia <span class="count">(5)</span></a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i>Southern Europe <span class="count">(5)</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div id="uou-tab-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="industry-title">Administrative and support services</h5>
                                        <ul class="industry-list list-unstyled mb0">
                                            <li><a href="#">Support Devices <span class="count">(453)</span></a></li>
                                            <li><a href="#">Consulting Services <span class="count">(54)</span></a></li>
                                            <li><a href="#">Customer Service <span class="count">(95)</span></a></li>
                                            <li><a href="#">Employment Placement <span class="count">(87)</span></a></li>
                                            <li><a href="#">Agencies/Recruiting <span class="count">(32)</span></a></li>
                                            <li><a href="#">Administration <span class="count">(52)</span></a></li>
                                            <li><a href="#">Secretarial <span class="count">(554)</span></a></li>
                                            <li><a href="#">Contracts/Purchasing <span class="count">(23)</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="industry-title">Manufacturing and instrustrials</h5>
                                        <ul class="industry-list list-unstyled mb0">
                                            <li><a href="#">Installation/Maintenance  <span class="count">(453)</span></a></li>
                                            <li><a href="#">Manufacturing and Production <span class="count">(54)</span></a></li>
                                            <li><a href="#">Mining  <span class="count">(95)</span></a></li>
                                            <li><a href="#">Safety/Environment <span class="count">(87)</span></a></li>
                                            <li><a href="#">Industrial  <span class="count">(32)</span></a></li>
                                            <li><a href="#">Manufacturing  <span class="count">(52)</span></a></li>
                                            <li><a href="#">Mechanical  <span class="count">(554)</span></a></li>
                                            <li><a href="#">Technical/Maintenance <span class="count">(23)</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="industry-title">Administrative and support services</h5>
                                        <ul class="industry-list list-unstyled mb0">
                                            <li><a href="#">Support Devices <span class="count">(453)</span></a></li>
                                            <li><a href="#">Consulting Services <span class="count">(54)</span></a></li>
                                            <li><a href="#">Customer Service <span class="count">(95)</span></a></li>
                                            <li><a href="#">Employment Placement <span class="count">(87)</span></a></li>
                                            <li><a href="#">Agencies/Recruiting <span class="count">(32)</span></a></li>
                                            <li><a href="#">Administration <span class="count">(52)</span></a></li>
                                            <li><a href="#">Secretarial <span class="count">(554)</span></a></li>
                                            <li><a href="#">Contracts/Purchasing <span class="count">(23)</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="industry-title">Manufacturing and instrustrials</h5>
                                        <ul class="industry-list list-unstyled mb0">
                                            <li><a href="#">Installation/Maintenance  <span class="count">(453)</span></a></li>
                                            <li><a href="#">Manufacturing and Production <span class="count">(54)</span></a></li>
                                            <li><a href="#">Mining  <span class="count">(95)</span></a></li>
                                            <li><a href="#">Safety/Environment <span class="count">(87)</span></a></li>
                                            <li><a href="#">Industrial  <span class="count">(32)</span></a></li>
                                            <li><a href="#">Manufacturing  <span class="count">(52)</span></a></li>
                                            <li><a href="#">Mechanical  <span class="count">(554)</span></a></li>
                                            <li><a href="#">Technical/Maintenance <span class="count">(23)</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div id="uou-tab-3">
                                <p class="type-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque placeat consectetur sit. Excepturi saepe dolorem nisi incidunt magni reprehenderit reiciendis odio temporibus minima? Veniam, asperiores voluptatem facilis autem mollitia alias.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="type-list list-unstyled mb0">
                                            <li><a href="#">Support Devices <span class="count">(453)</span></a></li>
                                            <li><a href="#">Consulting Services <span class="count">(54)</span></a></li>
                                            <li><a href="#">Customer Service <span class="count">(95)</span></a></li>
                                            <li><a href="#">Employment Placement <span class="count">(87)</span></a></li>
                                            <li><a href="#">Agencies/Recruiting <span class="count">(32)</span></a></li>
                                            <li><a href="#">Administration <span class="count">(52)</span></a></li>
                                            <li><a href="#">Secretarial <span class="count">(554)</span></a></li>
                                            <li><a href="#">Contracts/Purchasing <span class="count">(23)</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="type-list list-unstyled mb0">
                                            <li><a href="#">Support Devices <span class="count">(453)</span></a></li>
                                            <li><a href="#">Consulting Services <span class="count">(54)</span></a></li>
                                            <li><a href="#">Customer Service <span class="count">(95)</span></a></li>
                                            <li><a href="#">Employment Placement <span class="count">(87)</span></a></li>
                                            <li><a href="#">Agencies/Recruiting <span class="count">(32)</span></a></li>
                                            <li><a href="#">Administration <span class="count">(52)</span></a></li>
                                            <li><a href="#">Secretarial <span class="count">(554)</span></a></li>
                                            <li><a href="#">Contracts/Purchasing <span class="count">(23)</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="uou-tab-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="country-list list-unstyled mb0">
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/af.html") ?>" alt=""> Afghanistan <span>(7)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/lt.html") ?>" alt=""> Lithuania <span>(6)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/ie.html") ?>" alt=""> Ireland <span>(2)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/gb.html") ?>" alt=""> Great Britain <span>(7)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/fr.html") ?>" alt=""> France <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/bd.html") ?>" alt=""> Bangladesh <span>(4)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/be.html") ?>" alt=""> Belgium <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/ua.html") ?>" alt=""> Ukraine <span>(5)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/us.html") ?>" alt=""> United Stanes <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/ve.html") ?>" alt=""> Venezuela <span>(8)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/pl.html") ?>" alt=""> Poland <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/ro.html") ?>" alt=""> Romania <span>(6)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/no.html") ?>" alt=""> Norway <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/lu.html") ?>" alt=""> Luxemburg <span>(2)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/jp.html") ?>" alt=""> Japan <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/id.html") ?>" alt=""> Indonesia <span>(8)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/de.html") ?>" alt=""> Germany <span>(3)</span></a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="country-list list-unstyled mb0">
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/af.html") ?>" alt=""> Afghanistan <span>(7)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/lt.html") ?>" alt=""> Lithuania <span>(6)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/ie.html") ?>" alt=""> Ireland <span>(2)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/gb.html") ?>" alt=""> Great Britain <span>(7)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/fr.html") ?>" alt=""> France <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/bd.html") ?>" alt=""> Bangladesh <span>(4)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/be.html") ?>" alt=""> Belgium <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/ua.html") ?>" alt=""> Ukraine <span>(5)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/us.html") ?>" alt=""> United Stanes <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/ve.html") ?>" alt=""> Venezuela <span>(8)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/pl.html") ?>" alt=""> Poland <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/ro.html") ?>" alt=""> Romania <span>(6)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/no.html") ?>" alt=""> Norway <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/lu.html") ?>" alt=""> Luxemburg <span>(2)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/jp.html") ?>" alt=""> Japan <span>(3)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/id.html") ?>" alt=""> Indonesia <span>(8)</span></a></li>
                                            <li><a href="#"><img src="<?=site_url("/resources/img/flags/16/de.html") ?>" alt=""> Germany <span>(3)</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end .uou-tabs -->
                </div>
                <div class="col-md-3">
                    <div class="sidebar-listing">
                        <h5 class="sidebar-listing-title">Recently Reviewed</h5>
                        <div class="listing-offer">
                            <h6 class="title"><a href="#">Urban Escape Spa</a></h6>
                            <div class="listing-offer-thumbnail">
                                <img src="<?=site_url("/resources/img/listing-offer-thumbnail1.png") ?>" alt="">
                            </div>
                            <div class="listing-offer-content">
                                <span class="location"><i class="fa fa-map-marker"></i> Manila, Philippines</span>
                                <ul class="rate">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <span class="count">208 reviews</span>
                            </div>
                        </div>
                        <div class="listing-offer">
                            <h6 class="title"><a href="#">Shear Studio</a></h6>
                            <div class="listing-offer-thumbnail">
                                <img src="<?=site_url("/resources/img/listing-offer-thumbnail2.png") ?>" alt="">
                            </div>
                            <div class="listing-offer-content">
                                <span class="location"><i class="fa fa-map-marker"></i> Dhaka, Bangladesh</span>
                                <ul class="rate">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <span class="count">208 reviews</span>
                            </div>
                        </div>
                        <div class="listing-offer">
                            <h6 class="title"><a href="#">Derma Spa</a></h6>
                            <div class="listing-offer-thumbnail">
                                <img src="<?=site_url("/resources/img/listing-offer-thumbnail3.png") ?>" alt="">
                            </div>
                            <div class="listing-offer-content">
                                <span class="location"><i class="fa fa-map-marker"></i> Manila, Philippines</span>
                                <ul class="rate">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <span class="count">208 reviews</span>
                            </div>
                        </div>
                        <div class="listing-offer">
                            <h6 class="title"><a href="#">Kelly’s Spa</a></h6>
                            <div class="listing-offer-thumbnail">
                                <img src="<?=site_url("/resources/img/listing-offer-thumbnail4.png") ?>" alt="">
                            </div>
                            <div class="listing-offer-content">
                                <span class="location"><i class="fa fa-map-marker"></i> Manila, Philippines</span>
                                <ul class="rate">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                                <span class="count">208 reviews</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about about-section has-bg-image" data-bg-image="<?=site_url("/resources/img/about-bg.jpg") ?>">
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
                                    <img src="<?=site_url("/resources/img/about-thumbnail.png") ?>" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-7">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa in placeat voluptates omnis vel quod maiores perferendis, eaque quasi expedita, adipisci dolorum porro itaque quia nesciunt atque earum consequatur ex.</p>
                                    <ul class="list-unstyled mb0">
                                        <li><i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span></li>
                                        <li><i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span></li>
                                        <li><i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span></li>
                                        <li><i class="fa fa-angle-right"></i><span>Mauris in erat justo.</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div id="uou-tab-2v">
                                <div class="col-md-5">
                                    <img src="<?=site_url("/resources/img/about-thumbnail.png") ?>" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-7">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa in placeat voluptates omnis vel ddquod maiores perferendis, eaque quasi expedita, adipisci dolorum porro itaque quia nesciunt atque earum consequatur ex.</p>
                                    <ul class="list-unstyled mb0">
                                        <li><i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span></li>
                                        <li><i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span></li>
                                        <li><i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span></li>
                                        <li><i class="fa fa-angle-right"></i><span>Mauris in erat justo.</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div id="uou-tab-3v">
                                <div class="col-md-5">
                                    <img src="<?=site_url("/resources/img/about-thumbnail.png") ?>" alt="" class="img-responsive">
                                </div>
                                <div class="col-md-7">
                                    <p>Lorem ipsuddm dolor sit amet, consectetur adipisicing elit. Ipsa in placeat voluptates omnis vel quod maiores perferendis, eaque quasi expedita, adipisci dolorum porro itaque quia nesciunt atque earum consequatur ex.</p>
                                    <ul class="list-unstyled mb0">
                                        <li><i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span></li>
                                        <li><i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span></li>
                                        <li><i class="fa fa-angle-right"></i><span>Nam nec tellus a odio tincidunt</span></li>
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
                    <h3 class="section-title">Popular Listings</h3>
                    <div class="header-listing">
                        <h6>Sort by</h6>
                        <div class="custom-select-box">
                            <select name="order" class="custom-select">
                                <option value="0">Most popular</option>
                                <option value="1">The latest</option>
                                <option value="2">The best rating</option>
                            </select>
                        </div>
                        <ul class="listing-views">
                            <li class="active"><a href="#"><i class="fa fa-th"></i></a></li>
                        </ul>
                    </div>
                    <div class="listing listing-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="listing-grid listing-grid-1">
                                    <div class="listing-heading">
                                        <h5><a href="single_business.html">The Spa Wellness</a></h5>
                                    </div>
                                    <div class="listing-inner">
                                        <div class="flexslider default-slider">
                                            <ul class="slides">
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_5.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_6.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_7.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_8.png") ?>" alt=""></li>
                                            </ul>
                                            <div class="reviews">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <span class="count">208 reviews</span>
                                            </div>
                                        </div>
                                        <ul class="uou-accordions">
                                            <li class="">
                                                <a href="#"><i class="fa fa-user main-icon"></i> Information</a>
                                                <div>
                                                    <h5 class="title">Secondary Heading</h5>
                                                    <p>Consequat ipsum, nec sagit sem nibh id elit duis sed odio</p>
                                                    <div class="price">
                                                        <span class="currency">$</span>
                                                        <span class="price-inner">
                              59.00
                            </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="active">
                                                <a href="#"><i class="fa fa-envelope main-icon"></i> Services</a>
                                                <div>
                                                    <ul class="contact-info list-unstyled mb0">
                                                        <li>Toning Bamboo Revival</li>
                                                        <li>The Spa Reflexology</li>
                                                        <li>Oriental Acupressure</li>
                                                        <li>Sea Salt Body Scrub</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul> <!-- end .uou-accordions -->
                                        <div class="info-footer">
                                            <i class="fa fa-map-marker location"></i>
                                            <h6>Paris, France</h6>
                                            <i class="fa fa-bookmark bookmark pull-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="listing-grid listing-grid-1">
                                    <div class="listing-heading">
                                        <h5><a href="single_business.html">Sharene Hair & Beauty</a></h5>
                                    </div>
                                    <div class="listing-inner">
                                        <div class="flexslider default-slider">
                                            <ul class="slides">
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_6.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_7.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_8.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_9.png") ?>" alt=""></li>
                                            </ul>
                                            <div class="reviews">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <span class="count">208 reviews</span>
                                            </div>
                                        </div>
                                        <ul class="uou-accordions">
                                            <li class="">
                                                <a href="#"><i class="fa fa-user main-icon"></i> Information</a>
                                                <div>
                                                    <h5 class="title">Secondary Heading</h5>
                                                    <p>Consequat ipsum, nec sagit sem nibh id elit duis sed odio</p>
                                                    <div class="price">
                                                        <span class="currency">$</span>
                                                        <span class="price-inner">
                              59.00
                            </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="active">
                                                <a href="#"><i class="fa fa-envelope main-icon"></i> Services</a>
                                                <div>
                                                    <ul class="contact-info list-unstyled mb0">
                                                        <li>Toning Bamboo Revival</li>
                                                        <li>The Spa Reflexology</li>
                                                        <li>Oriental Acupressure</li>
                                                        <li>Sea Salt Body Scrub</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul> <!-- end .uou-accordions -->
                                        <div class="info-footer">
                                            <i class="fa fa-map-marker location"></i>
                                            <h6>Paris, France</h6>
                                            <i class="fa fa-bookmark bookmark pull-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="listing-grid listing-grid-1">
                                    <div class="listing-heading">
                                        <h5><a href="single_business.html">The Director’s Club</a></h5>
                                    </div>
                                    <div class="listing-inner">
                                        <div class="flexslider default-slider">
                                            <ul class="slides">
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_7.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_8.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_9.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_10.png") ?>" alt=""></li>
                                            </ul>
                                            <div class="reviews">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <span class="count">208 reviews</span>
                                            </div>
                                        </div>
                                        <ul class="uou-accordions">
                                            <li class="">
                                                <a href="#"><i class="fa fa-user main-icon"></i> Information</a>
                                                <div>
                                                    <h5 class="title">Secondary Heading</h5>
                                                    <p>Consequat ipsum, nec sagit sem nibh id elit duis sed odio</p>
                                                    <div class="price">
                                                        <span class="currency">$</span>
                                                        <span class="price-inner">
                              59.00
                            </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="active">
                                                <a href="#"><i class="fa fa-envelope main-icon"></i> Services</a>
                                                <div>
                                                    <ul class="contact-info list-unstyled mb0">
                                                        <li>Toning Bamboo Revival</li>
                                                        <li>The Spa Reflexology</li>
                                                        <li>Oriental Acupressure</li>
                                                        <li>Sea Salt Body Scrub</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul> <!-- end .uou-accordions -->
                                        <div class="info-footer">
                                            <i class="fa fa-map-marker location"></i>
                                            <h6>Paris, France</h6>
                                            <i class="fa fa-bookmark bookmark pull-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="listing-grid listing-grid-1">
                                    <div class="listing-heading">
                                        <h5><a href="single_business.html">Authentic Massage</a></h5>
                                    </div>
                                    <div class="listing-inner">
                                        <div class="flexslider default-slider">
                                            <ul class="slides">
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_8.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_10.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_9.png") ?>" alt=""></li>
                                                <li><img src="<?=site_url("/resources/img/slider-img/lv3_thumbnail_7.png") ?>" alt=""></li>
                                            </ul>
                                            <div class="reviews">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                                <span class="count">208 reviews</span>
                                            </div>
                                        </div>
                                        <ul class="uou-accordions">
                                            <li class="">
                                                <a href="#"><i class="fa fa-user main-icon"></i> Information</a>
                                                <div>
                                                    <h5 class="title">Secondary Heading</h5>
                                                    <p>Consequat ipsum, nec sagit sem nibh id elit duis sed odio</p>
                                                    <div class="price">
                                                        <span class="currency">$</span>
                                                        <span class="price-inner">
                              59.00
                            </span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="active">
                                                <a href="#"><i class="fa fa-envelope main-icon"></i> Services</a>
                                                <div>
                                                    <ul class="contact-info list-unstyled mb0">
                                                        <li>Toning Bamboo Revival</li>
                                                        <li>The Spa Reflexology</li>
                                                        <li>Oriental Acupressure</li>
                                                        <li>Sea Salt Body Scrub</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul> <!-- end .uou-accordions -->
                                        <div class="info-footer">
                                            <i class="fa fa-map-marker location"></i>
                                            <h6>Paris, France</h6>
                                            <i class="fa fa-bookmark bookmark pull-right"></i>
                                        </div>
                                    </div>
                                </div>
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

    <div class="sponsors sponsors-2 has-bg-image" data-bg-image="<?=site_url("/resources/img/banner-mission.jpg") ?>" data-bg-color="00D793" data-bg-opacity=".20">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">Our Sponsors</h3>
                    <div class="sponsors-slider">
                        <div class="item"><img src="<?=site_url("/resources/img/sponsor_logo1_1.png") ?>" alt="" class="img-responsive"></div>
                        <div class="item"><img src="<?=site_url("/resources/img/sponsor_logo2_2.png") ?>" alt="" class="img-responsive"></div>
                        <div class="item"><img src="<?=site_url("/resources/img/sponsor_logo3_3.png") ?>" alt="" class="img-responsive"></div>
                        <div class="item"><img src="<?=site_url("/resources/img/sponsor_logo4_4.png") ?>" alt="" class="img-responsive"></div>
                        <div class="item"><img src="<?=site_url("/resources/img/sponsor_logo5_5.png") ?>" alt="" class="img-responsive"></div>
                        <div class="item"><img src="<?=site_url("/resources/img/sponsor_logo6_6.png") ?>" alt="" class="img-responsive"></div>
                        <div class="item"><img src="<?=site_url("/resources/img/sponsor_logo4_4.png") ?>" alt="" class="img-responsive"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="uou-block-4e has-bg-image" data-bg-color="ffffff">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#" class="logo"><img src="<?=site_url("/resources/img/logo.png") ?>" alt=""></a>

                    <ul style="background-image: url(_<?=site_url("/resources/img/footer-map-bg.png")?>);" class="contact-info has-bg-image contain" data-bg-image="<?=site_url("/resources/img/footer-map-bg.png") ?>">
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
                            RT <a href="#">@no1son</a>: Now this <a href="#">http://t.co/TSfMW1qMAW</a> is one hell of a stunning site!!! Awesome work guys <a href="#">@AIRNAUTS</a>
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
                        <li><img src="<?=site_url("/resources/img/photostream4.jpg") ?>" alt=""></li>
                        <li><img src="<?=site_url("/resources/img/photostream6.jpg") ?>" alt=""></li>
                        <li><img src="<?=site_url("/resources/img/photostream3.jpg") ?>" alt=""></li>
                        <li><img src="<?=site_url("/resources/img/photostream2.jpg") ?>" alt=""></li>
                        <li><img src="<?=site_url("/resources/img/photostream1.jpg") ?>" alt=""></li>
                        <li><img src="<?=site_url("/resources/img/photostream.jpg") ?>" alt=""></li>
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
<script src="<?=site_url("/resources/js/googlemaplocal.js") ?>"></script>
<script src="<?=site_url("/resources/js/jquery-2.1.3.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/plugins/superfish.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/jquery.ui.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/plugins/rangeslider.min.js") ?>"></script>

<script src="<?=site_url("/resources/js/plugins/jquery.flexslider-min.js") ?>"></script>

<script src="<?=site_url("/resources/js/uou-accordions.js") ?>"></script>

<script src="<?=site_url("/resources/js/uou-tabs.js") ?>"></script>
<script src="<?=site_url("/resources/js/plugins/select2.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/owl.carousel.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/gmap3.min.js") ?>"></script>
<script src="<?=site_url("/resources/js/bootstrap.js") ?>"></script>
<script src="<?=site_url("/resources/js/scripts.js") ?>"></script>

</body>

<!-- Mirrored from new.uouapps.com/quick-finder/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:23 GMT -->
</html>
