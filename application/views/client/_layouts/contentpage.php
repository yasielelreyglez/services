<!doctype html>
<html lang="en">

<!-- Mirrored from new.uouapps.com/quick-finder/index_business1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:31 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Quickfinder Business Homepage</title>

    <!-- Stylesheets -->
    <link rel="stylesheet"
          href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700%7CDroid+Serif:300,400,700,400italic">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <?php echo link_tag("/resources/ajax/libs/select2/4.0.0/css/select2.min.css") ?>
    <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic' rel='stylesheet'
          type='text/css'>
    <?php echo link_tag("/resources/css/style.css") ?>
    <?php echo link_tag("/resources/css/yasiel.css") ?>
</head>

<body>
<div id="main-wrapper">
    <?php $this->load->view('/client/_partials/toolbar') ?>

    <?php $this->load->view('/client/_partials/header-nav') ?>

    <div class="main-content content-business has-bg-image" data-bg-color="f5f5f5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="sidebar-categories">
                            <h6>Categories</h6>
                            <ul>
                                <li>
                                    <input type="checkbox">
                                    <span class="title">Cinema</span>
                                    <span class="count">5</span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <span class="title">Massage Parlor</span>
                                    <span class="count">4</span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <span class="title">Hairdresser</span>
                                    <span class="count">3</span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <span class="title">Car Repair</span>
                                    <span class="count">3</span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <span class="title">Laundry</span>
                                    <span class="count">3</span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <span class="title">Finance and legal</span>
                                    <span class="count">3</span>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-categories">
                            <h6>Cities</h6>
                            <ul>
                                <li>
                                    <input type="checkbox">
                                    <span class="title">Car Repair</span>
                                    <span class="count">3</span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <span class="title">Laundry</span>
                                    <span class="count">3</span>
                                </li>
                                <li>
                                    <input type="checkbox">
                                    <span class="title">Finance and legal</span>
                                    <span class="count">3</span>
                                </li>
                            </ul>
                        </div>
                        <div class="sidebar-scrollbars">
                            <h6>Date Posted:</h6>
                            <div class="slider-range-container">
                                <div class="slider-range" data-min="1" data-max="50" data-step="1" data-default-min="1"
                                     data-default-max="50" data-currency="&nbsp;"></div>
                                <div class="clearfix">
                                    <input type="text" class="range-from" value="1">
                                    <input type="text" class="range-to" value="50">
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-button">
                            <button class="btn-medium btn-primary full-width">Filter Results</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="header-listing">
                        <ul class="listing-views">
                            <li class="active view-type" data-type="listing-3"><a href="#"><i class="fa fa-th"></i></a>
                            </li>
                            <li class="view-type" data-type="listing-1"><a href="#"><i class="fa fa-list"></i></a></li>
                        </ul>
                    </div>
                    <?php $this->load->view($content) ?>
                </div>
                <div class="col-md-12 text-center">
                    <ul class="pagination">
                        <li><a href="#."><i class="fa fa-angle-left"></i></a></li>
                        <li><a href="#.">1</a></li>
                        <li class="current"><a href="#.">2</a></li>
                        <li><a href="#.">3</a></li>
                        <li><a href="#.">4</a></li>
                        <li><a href="#.">3</a></li>
                        <li><a href="#.">5</a></li>
                        <li><a href="#.">6</a></li>
                        <li><a href="#.">7</a></li>
                        <li><a href="#.">8</a></li>
                        <li><a href="#.">9</a></li>
                        <li><a href="#.">10</a></li>
                        <li><a href="#.">11</a></li>
                        <li><a href="#">12</a></li>
                        <li><a href="#">13</a></li>
                        <li><a href="#."><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('/client/_partials/footer') ?>
</div>

<?php $this->load->view('/client/_partials/sidebar-nav') ?>

<!-- Scripts -->

<script src="<?= site_url("/resources/js/jquery-2.1.3.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/superfish.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/jquery.ui.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/rangeslider.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/jquery.flexslider-min.js") ?>"></script>
<script src="<?= site_url("/resources/js/uou-accordions.js") ?>"></script>
<script src="<?= site_url("/resources/js/uou-tabs.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/select2.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/owl.carousel.min.js") ?>"></script>
<!--<script src="--><? //= site_url("/resources/js/gmap3.min.js") ?><!--"></script>-->
<script src="<?= site_url("/resources/js/scripts.js") ?>"></script>
<script src="<?= site_url("/resources/js/bootstrap.js") ?>"></script>

</body>

<!-- Mirrored from new.uouapps.com/quick-finder/index_business1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:44 GMT -->
</html>

<script>
    $(document).on('ready', function () {
        var $viewtype = $('.view-type');
        $viewtype.click(function () {
            var $this = $(this);
            $('.listing').addClass('hidden');
            var type = $this.data('type');
            $('#' + type).removeClass('hidden');
            $viewtype.removeClass('active');
            $this.addClass('active');
        });
    });
</script>
