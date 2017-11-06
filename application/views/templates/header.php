<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 11/5/2017
 * Time: 7:51 PM
 */?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>


    <?php echo link_tag("/src/assets/bootstrap.min.css") ?>
</head>
<body>
<!--<ul class="nav nav-pills nav-justified align-center">-->
<ul class="nav nav-tabs align-content-center">

    <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Longer nav link</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
    </li>
</ul>
<div id="container">
    <?php
    if (count($errors)>0){
       echo '<div class="row">';
        foreach ($errors as $error=>$val) {
            echo "<div class='alert alert-danger' role='alert'><h5 class=\"alert-heading\">$error</h5>$val</div>";
        }
        echo'</div>';
    }
    ?>

    <div class="row">