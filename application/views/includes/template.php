<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="robots" content="ALL" />
	<title>CodeIgniter 3x Scaffold</title>

    <?php echo link_tag("/resources/css/bootstrap.min.css") ?>
<!--	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">-->
<!--	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">-->

</head>
<body>
<nav class="navbar navbar-default" role="navigation">
<ul class="nav nav-tabs align-content-center">
    <?php
    if(!isset($tab)){
        $tab ="nomtab";
    }
    ?>
    <li class="nav-item">
<!--        <a class="nav-link --><?//=$tab=="category"?"active":""?><!--" href="--><?//=site_url()?><!--/categoryc/">Categorias</a>-->
        <?= anchor('admin/categoryc', 'Categorias', $tab=="category"?"class='active nav-link'":"class='nav-link'");?>
    </li>
    <li class="nav-item">
        <?= anchor('admin/subcategory', 'Subcategorias', $tab=="subcategory"?"class='active nav-link'":"class='nav-link'");?>
    </li>
    <li class="nav-item">
        <?= anchor('admin/users', 'Usuarios', $tab=="user"?"class='active nav-link'":"class='nav-link'");?>

    </li>
    <li class="nav-item">
        <?= anchor('admin/services', 'Servicios', $tab=="services"?"class='active nav-link'":"class='nav-link'");?>

    </li>
    <li class="nav-item">
        <?= anchor('admin/cities', 'Ciudades', $tab=="cities"?"class='active nav-link'":"class='nav-link'");?>

    </li>
    <li class="nav-item">
        <?= anchor('admin/positions', 'Posiciones', $tab=="position"?"class='active nav-link'":"class='nav-link'");?>

    </li>

</ul>
</nav>
  <!-- Brand and toggle get grouped for better mobile display -->

	<div class="container">
		<div class="row">
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="<?php echo base_url()?>/src/assets/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>/src/assets/popper.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>/src/assets/bootstrap.min.js"></script>
</body>
</html>
