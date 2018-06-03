<?php
/**
 * Created by PhpStorm.
 * User: Kenny
 * Date: 5/31/2018
 * Time: 2:11 AM
 */
?>
<?= form_open('admin/pagesc/saveBanner', 'role="form"'); ?><?php if (validation_errors() != NULL && validation_errors() != '') { ?>
    <div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
<input type="hidden" name="id" value="<?= isset($banner)?$banner->getId():''?>"/>

<div class="form-group">
    <label for="title">Nombre:</label><br/>
    <input type="text" required class="form-control" name="name" placeholder="Escriba el nombre"
           value="<?= isset($banner)?$banner->getName():''?>"/>
</div>

<div class="form-group">
    <label for="title">Título:</label><br/>
    <input type="text" required class="form-control" name="title" placeholder="Escriba el título"
           value="<?= isset($banner)?$banner->getTitle():''?>"/>
</div>

<div class="form-group">
    <label for="title">Subtítulo:</label><br/>
    <input type="text" class="form-control" name="subtitle" placeholder="Escriba el subtítulo"
           value="<?= isset($banner)?$banner->getSubtitle():''?>"/>
</div>

<div class="form-group">
    <label for="days">Dirección para imagen de fondo:</label><br/>
    <input type="text" required class="form-control" name="urlimagen"
           placeholder="Escriba dirección para imagen de fondo"
           value="<?= isset($banner)?$banner->getImage():''?>"/>
</div>

<input type="submit" value="Guardar" class="btn btn-primary pull-right"/>
<?= anchor('admin/pagesc/personalize','Cancelar','class="btn btn-link pull-right"'); ?>
</form>