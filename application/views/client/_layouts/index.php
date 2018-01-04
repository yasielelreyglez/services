<!doctype html>
<html lang="en">

<!-- Mirrored from new.uouapps.com/quick-finder/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 09 Nov 2017 14:43:12 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Servicios</title>

    <!-- Stylesheets -->
    <link rel="stylesheet"
          href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,300,400,600,700%7CDroid+Serif:300,400,700,400italic">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <?php echo link_tag("/resources/ajax/libs/select2/4.0.0/css/select2.min.css") ?>
    <?php echo link_tag("/resources/css/owl.carousel.css") ?>
    <?php echo link_tag("/resources/css/style.css") ?>
</head>

<body>
<div id="main-wrapper" class="homepage">
    <?php $this->load->view('/client/_partials/toolbar') ?>

    <?php $this->load->view('/client/_partials/header-nav') ?>

    <?php $this->load->view('/client/_partials/header-filter') ?>

    <?php $this->load->view($content) ?>

    <?php $this->load->view('/client/_partials/footer') ?>

</div>

<?php $this->load->view('/client/_partials/sidebar-nav') ?>

<script>
    var markers2 = [
        {position: [48.8620722, 2.352047]},
        {address: "86000 Poitiers, France"},
        {address: "66000 Perpignan, France", icon: "http://maps.google.com/mapfiles/marker_grey.png"}
    ];
    var markers3 = [
        {
            lat: 37.780823,
            lng: -122.4231,
            title: 'Marker 1'
        },
        {
            lat: 37.768068680454725,
            lng: -122.430739402771,
            title: 'Marker 2'
        },
        {
            lat: 37.7791272169824,
            lng: -122.4296236038208,
            title: 'Marker 3'
        },
        {
            lat: 37.770715,
            lng: -122.392631,
            title: 'Marker 4'
        },
        {
            lat: 37.78197638783258,
            lng: -122.45829105377197,
            title: 'Marker 5'
        },
        {
            lat: 37.769629187677,
            lng: -122.46798992156982,
            title: 'Marker 6'
        }
    ];
</script>
<script src="<?= site_url("/resources/js/jquery-2.1.3.min.js") ?>"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxooB5CXv3oWSzKldWJzStShRvWE8X1MA&callback=initMap"></script>

<script src="<?= site_url("/resources/js/plugins/superfish.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/jquery.ui.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/rangeslider.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/jquery.flexslider-min.js") ?>"></script>
<script src="<?= site_url("/resources/js/uou-accordions.js") ?>"></script>
<script src="<?= site_url("/resources/js/uou-tabs.js") ?>"></script>
<script src="<?= site_url("/resources/js/plugins/select2.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/owl.carousel.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/gmap3.min.js") ?>"></script>
<script src="<?= site_url("/resources/js/scripts.js") ?>"></script>
<script src="<?= site_url("/resources/js/bootstrap.js") ?>"></script>

</body>
</html>
