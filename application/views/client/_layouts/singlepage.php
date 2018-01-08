<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Servicio</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700%7CDroid+Serif:300,400,700,400italic">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <?php echo link_tag("/resources/ajax/libs/select2/4.0.0/css/select2.min.css") ?>
    <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>

    <?php echo link_tag("/resources/css/style.css") ?>
    <?php echo link_tag("/resources/css/yasiel.css") ?>
</head>

<body>
<div id="main-wrapper">
    <?php $this->load->view('/client/_partials/toolbar') ?>

    <?php $this->load->view('/client/_partials/header-nav') ?>

<!--    <div class="uou-block-3a">-->
<!--        <div class="container">-->
<!--            <ul class="breadcrumbs">-->
<!--                <li><a href="#">Home</a></li>-->
<!--                <li><a href="#">Jobs</a></li>-->
<!--                <li><span>Job Details</span></li>-->
<!--            </ul><ul class="pagination">-->
<!--                <li><a href="#"><i class="fa fa-angle-left"></i> Prev</a></li>-->
<!--                <li><a href="#">Back</a></li>-->
<!--                <li><a href="#">Next <i class="fa fa-angle-right"></i></a></li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->

    <div class="subheader has-bg-image" data-bg-image="<?= site_url("/resources/img/single-business-header.jpg") ?>">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="subheader-title"><?= $object->title ?></h3>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view($content) ?>

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

</html>
