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
        <a class="nav-link" id="profile2-tab" data-toggle="tab" href="#pages" role="tab" aria-controls="profile2"
           aria-selected="false">Pages</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#regions" role="tab" aria-controls="profile"
           aria-selected="false">Regiones</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="banners" role="tabpanel" aria-labelledby="home-tab">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Imagen</th>
                <th colspan="2">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($banners as $key=>$banner) { ?>
                <tr class="element">
                <td><?= $key+1 ?></td>
                <td class="element-title"><?= $banner->getName() ?></td>
                <td class="element-title"><?= $banner->getTitle() ?></td>
                <td class="element-title"><?= $banner->getSubtitle() ?></td>
                <td>
                    <div class="card m-3 disabled" style="width: 18rem;">
                        <img class="payment-evidence card-img-top"  height="40px" width="45px"  src="<?= $banner->getImage() ?>"
                             alt="Card image cap">
                    </div>
                </td>
                <td width="80"><?= anchor('admin/pagesc/editBanner/' . $banner->getId(), 'Editar', 'class="btn btn-warning"'); ?></td>
                <td width="80"><?= anchor('admin/pagesc/destroyBanner/' . $banner->getId(), 'Eliminar', 'class="btn btn-danger destroy"'); ?></td>
                </tr><?php } ?>
            </tbody>
        </table>
        <?= anchor('admin/pagesc/createBanner', 'Crear', 'class="btn btn-primary"'); ?>
    </div>
    <div class="tab-pane fade" id="pages" role="tabpanel" aria-labelledby="profile2-tab">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Contenido</th>
                <th colspan="2">Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pages as $key2=>$page) { ?>
                <tr class="element">
                <td><?= $key2+1 ?></td>
                <td class="element-title"><?= $page->getTitle() ?></td>
                <td class="element-title"><?= $page->getContent() ?></td>
                <td width="80"><?= anchor('admin/pagesc/editar/' . $page->getId(), 'Editar', 'class="btn btn-warning"'); ?></td>
                <td width="80"><?= anchor('admin/pagesc/destroy/' . $page->getId(), 'Eliminar', 'class="btn btn-danger destroy"'); ?></td>
                </tr><?php } ?>
            </tbody>
        </table>
        <?= anchor('admin/pagesc/create', 'Crear', 'class="btn btn-primary"'); ?>
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

<!-- The Modal -->
<div id="imageZoomModal" class="modal">

    <!-- Modal Caption (Image Text) -->
    <div id="caption" style="text-align: center"></div>

    <!-- The Close Button -->
    <span class="close">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01">
</div>