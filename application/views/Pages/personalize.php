<?php
/**
 * Created by PhpStorm.
 * User: Kenny
 * Date: 5/30/2018
 * Time: 10:34 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#banners" role="tab" aria-controls="home"
           aria-selected="true">Banner</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#regions" role="tab" aria-controls="profile"
           aria-selected="false">Regiones</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="banners" role="tabpanel" aria-labelledby="home-tab">
        <?php foreach ($banners as $banner) : ?>
            <div class="card element">
                <div class="card-header element-title">
                    Banner para <?= $banner->getName(); ?>
                    <a href="<?= site_url('admin/pagesc/destroyBanner/' . $banner->getId()) ?>"
                       class="destroy pull-right"><i
                                class="fa fa-remove"></i></a>
                </div>
                <div class="card-body">
                    <?= form_open('admin/pagesc/saveBanner', 'role="form"'); ?><?php if (validation_errors() != NULL && validation_errors() != '') { ?>
                        <div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
                    <input type="hidden" name="id" value="<?= $banner->getId(); ?>"/>
                    <input type="hidden" name="name" value="<?= $banner->getName(); ?>"/>

                    <div class="form-group">
                        <label for="title">Título:</label><br/>
                        <input type="text" required class="form-control" name="title" placeholder="Escriba el título"
                               value="<?= $banner->getTitle(); ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="title">Subtítulo:</label><br/>
                        <input type="text" class="form-control" name="subtitle" placeholder="Escriba el subtítulo"
                               value="<?= $banner->getSubtitle(); ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="days">Dirección para imagen de fondo:</label><br/>
                        <input type="text" required class="form-control" name="urlimagen"
                               placeholder="Escriba dirección para imagen de fondo"
                               value="<?= $banner->getImage(); ?>"/>
                    </div>

                    <input type="submit" value="Guardar" class="btn btn-primary pull-right"/>
                    </form>
                </div>
            </div>
            <br>
        <?php endforeach; ?>
        <?= anchor('admin/pagesc/createBanner', 'Crear', 'class="btn btn-info"'); ?>
    </div>
    <div class="tab-pane fade" id="regions" role="tabpanel" aria-labelledby="profile-tab">
        <div class="form-group">
            <label for="cities">Redes sociales del menú superior:</label>
            <select multiple="true" class="custom-select" name="cities[]"
                    placeholder="Escoja la ciudad">
                <optgroup label="Páginas">
                    <?php
                    foreach ($pages as $page) {
                        echo "<option value='$page->id'>$page->title </option>";
                    }
                    ?>
                </optgroup>
                <optgroup label="Banners">
                    <?php
                    foreach ($banners as $banner) {
                        echo "<option value='$banner->getId()'>".$banner->getTitle()." </option>";
                    }
                    ?>
                </optgroup>
            </select>
        </div>
    </div>
</div>
