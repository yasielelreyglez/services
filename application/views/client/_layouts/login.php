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
    <?php $this->load->view('/client/_partials/toolbar') ?>

    <?php $this->load->view('/client/_partials/header-nav') ?>
    <div class="homepage-banner has-bg-image" data-bg-image="<?=site_url("/resources/img/homepage-banner.jpg") ?>">
        <div class="advanced-search">
            <div class="close">
                <i class="fa fa-close"></i>
            </div>
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
        <?php $this->load->view($content); ?>
<!--    <div class="listing-objects">-->
<!--        <div class="container">-->
<!--        --><?php //if(isset($errors)) { ?>
<!--            <div class="alert alert-danger">-->
<!--                --><?php //foreach ($errors as $error) { ?>
<!--                    --><?//= $error; ?>
<!--                --><?php //} ?>
<!--            </div>-->
<!--        --><?php //} ?>
<!--        --><?php //$this->load->view($content); ?>
<!--        </div>-->
<!--    </div>-->
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
