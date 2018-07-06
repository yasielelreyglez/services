<?php
/**
 * Created by PhpStorm.
 * User: Yoidel
 * Date: 6/31/2018
 * Time: 2:11 AM
 */
?>
<?= form_open('admin/pagesc/saveBanner', 'role="form"'); ?><?php if (validation_errors() != NULL && validation_errors() != '') { ?>
    <div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
<input type="hidden" name="id" value="<?= isset($bannerEdit)?$bannerEdit->getId():''?>"/>

<div class="form-group">
    <label for="title">Nombre:</label><br/>
    <input type="text" required class="form-control" name="name" placeholder="Escriba el nombre"
           value="<?= isset($bannerEdit)?$bannerEdit->getName():''?>"/>
</div>

<div class="form-group">
    <label for="title">Título:</label><br/>
    <input type="text" required class="form-control" name="title" placeholder="Escriba el título"
           value="<?= isset($bannerEdit)?$bannerEdit->getTitle():''?>"/>
</div>

<div class="form-group">
    <label for="title">Subtítulo:</label><br/>
    <input type="text" class="form-control" name="subtitle" placeholder="Escriba el subtítulo"
           value="<?= isset($bannerEdit)?$bannerEdit->getSubtitle():''?>"/>
</div>

<div class="form-group">
    <label for="days">Dirección para imagen de fondo:</label><br/>
    <input type="text" required class="form-control" name="urlimagen"
           placeholder="Escriba dirección para imagen de fondo"
           value="<?= isset($bannerEdit)?$bannerEdit->getImage():''?>"/>
</div>

<input type="submit" value="Guardar" class="btn btn-primary pull-right"/>
<?= anchor('admin/pagesc/personalize','Cancelar','class="btn btn-link pull-right"'); ?>
</form>