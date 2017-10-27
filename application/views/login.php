<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 10/25/2017
 * Time: 3:18 PM
 */
echo link_tag("resources/css/Styles.css");
base_url()
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Angular App</title>
    <base href="/">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <?php echo link_tag("/dist/assets/bootstrap.min.css") ?>
</head>

<body>
<app-root></app-root>

<script type="text/javascript" src="<?php echo base_url()?>/dist/inline.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/dist/polyfills.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/dist/styles.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/dist/vendor.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/dist/main.bundle.js"></script></body>

</html>