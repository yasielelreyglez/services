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
        <?= form_open('admin/pagesc/saveConfig', 'role="form"'); ?><?php if (validation_errors() != NULL && validation_errors() != '') { ?>
            <div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
        <div class="row">
            <div class="col-md-6">
                <!--                <label>Personalizar</label>-->
            </div>
            <div class="col-md-6">
                <input type="submit" value="Guardar" class="btn btn-primary pull-right"/>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="accordion" id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingZero">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseZero"
                                        aria-expanded="true" aria-controls="collapseZero">
                                    Personalización global
                                </button>
                            </h5>
                        </div>

                        <div id="collapseZero" class="collapse show" aria-labelledby="headingZero"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Región de redes sociales del menú superior:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'socialsTopMenu')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['global']['socialsTopMenu']['type']"
                                                   value="page">
                                            <select class="custom-select"
                                                    name="['global']['socialsTopMenu']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido global de la ayuda:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'globalHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['global']['globalHelp']['type']" value="page">
                                            <select class="custom-select" name="['global']['globalHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                        data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                    Personalizar página de inicio
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'homeBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['home']['homeBanner']['type']" value="banner">
                                            <select class="custom-select" name="['home']['homeBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la ayuda de la página de inicio:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'homeHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['home']['homeHelp']['type']" value="page">
                                            <select class="custom-select" name="['home']['homeHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la sección Acerca de:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'aboutUsRegion')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['home']['aboutUsRegion']['type']" value="page">
                                            <select class="custom-select" name="['home']['aboutUsRegion']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la sección Sponsors:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'sponsorsRegion')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['home']['sponsorsRegion']['type']" value="page">
                                            <select class="custom-select" name="['home']['sponsorsRegion']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la sección final:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'preFooterRegion')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['home']['preFooterRegion']['type']"
                                                   value="page">
                                            <select class="custom-select"
                                                    name="['home']['preFooterRegion']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido del pie de página:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'footerRegion')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['home']['footerRegion']['type']" value="page">
                                            <select class="custom-select" name="['home']['footerRegion']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Personalizar páginas de gestión de pago
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página inicio de pagos:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'paymentStarBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['payment']['paymentStarBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['payment']['paymentStarBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página pagos solicitados:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'paymentRequestedBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['payment']['paymentRequestedBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['payment']['paymentRequestedBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página pagos activos:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'paymentEnabledBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['payment']['paymentEnabledBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['payment']['paymentEnabledBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página pagos expirados:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'paymentExpiredBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['payment']['paymentExpiredBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['payment']['paymentExpiredBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página pagos denegados:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'paymentDeniedBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['payment']['paymentDeniedBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['payment']['paymentDeniedBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página pagos membresías:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'paymentMembresiaBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['payment']['paymentMembresiaBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['payment']['paymentMembresiaBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página crear membresías:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'paymentMembresiaAddBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['payment']['paymentMembresiaAddBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['payment']['paymentMembresiaAddBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página editar membresías:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'paymentMembresiaEditBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['payment']['paymentMembresiaEditBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['payment']['paymentMembresiaEditBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la ayuda de pagos:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'paymentHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['payment']['paymentHelp']['type']" value="page">
                                            <select class="custom-select" name="['payment']['paymentHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                    Personalizar páginas de gestión de servicio
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página inicio de servicios:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'servicesStarBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['services']['servicesStarBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['services']['servicesStarBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página servicios denunciados:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'servicesComplaintBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['services']['servicesComplaintBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['services']['servicesComplaintBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página ver servicio:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'servicesShowBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['services']['servicesShowBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['services']['servicesShowBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página crear servicio:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'servicesAddBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['services']['servicesAddBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['services']['servicesAddBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página editar servicio:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'servicesEditBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['services']['servicesEditBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['services']['servicesEditBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la ayuda de servicios:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'servicesHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['services']['servicesHelp']['type']"
                                                   value="page">
                                            <select class="custom-select"
                                                    name="['services']['servicesHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Personalizar páginas de gestión de categorías
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página inicio de categorías:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'categoriesStarBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['categories']['categoriesStarBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['categories']['categoriesStarBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página crear categoría:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'categoriesAddBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['categories']['categoriesAddBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['categories']['categoriesAddBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página editar categoría:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'categoriesEditBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['categories']['categoriesEditBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['categories']['categoriesEditBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la ayuda de categorías:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'categoriesHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['categories']['categoriesHelp']['type']"
                                                   value="page">
                                            <select class="custom-select"
                                                    name="['categories']['categoriesHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFive">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Personalizar páginas de gestión de subcategorías
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página inicio de subcategorías:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'subcategoriesStarBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden"
                                                   name="['subcategories']['subcategoriesStarBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['subcategories']['subcategoriesStarBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página crear subcategoría:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'subcategoriesAddBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden"
                                                   name="['subcategories']['subcategoriesAddBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['subcategories']['subcategoriesAddBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página editar subcategoría:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'subcategoriesEditBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden"
                                                   name="['subcategories']['subcategoriesEditBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['subcategories']['subcategoriesEditBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la ayuda de subcategorías:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'subcategoriesHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['subcategories']['subcategoriesHelp']['type']"
                                                   value="page">
                                            <select class="custom-select"
                                                    name="['subcategories']['subcategoriesHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSix">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Personalizar páginas de gestión de ciudades
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página inicio de ciudades:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'cityStarBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['city']['cityStarBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select" name="['city']['cityStarBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página crear ciudades:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'cityAddBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['city']['cityAddBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select" name="['city']['cityAddBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página editar ciudades:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'cityEditBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['city']['cityEditBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select" name="['city']['cityEditBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la ayuda de ciudades:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'cityHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['city']['cityHelp']['type']" value="page">
                                            <select class="custom-select" name="['city']['cityHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingSeven">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseSeven" aria-expanded="false"
                                        aria-controls="collapseSeven">
                                    Personalizar páginas de gestioón usuarios
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página inicio de usuarios:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'userStarBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['user']['userStarBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select" name="['user']['userStarBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página crear usuario:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'userAddBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['user']['userAddBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select" name="['user']['userAddBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página editar usuario:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'userEditBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['user']['userEditBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select" name="['user']['userEditBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la ayuda de usuarios:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'userHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['user']['userHelp']['type']" value="page">
                                            <select class="custom-select" name="['user']['userHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingEight">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseEight" aria-expanded="false"
                                        aria-controls="collapseEight">
                                    Personalizar páginas de gestión de personalización
                                </button>
                            </h5>
                        </div>
                        <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página inicio de personalizar:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'personalizeStarBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['personalize']['personalizeStarBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['personalize']['personalizeStarBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página crear página:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'pageAddBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['personalize']['pageAddBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['personalize']['pageAddBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página ver página:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'pageShowBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['personalize']['pageShowBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['personalize']['pageShowBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página editar página:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'pageEditBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['personalize']['pageEditBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['personalize']['pageEditBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página crear banner:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'bannerAddBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['personalize']['bannerAddBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['personalize']['bannerAddBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página editar banner:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'bannerEditBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['personalize']['bannerEditBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select"
                                                    name="['personalize']['bannerEditBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la ayuda de personalizar:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'personalizeHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['personalize']['personalizeHelp']['type']"
                                                   value="page">
                                            <select class="custom-select"
                                                    name="['personalize']['personalizeHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingNine">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                    Personalizar páginas de gestión de imágenes
                                </button>
                            </h5>
                        </div>
                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Banner página imágenes:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'imagenBanner')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['imagen']['imagenBanner']['type']"
                                                   value="banner">
                                            <select class="custom-select" name="['imagen']['imagenBanner']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($banners as $banner) {
                                                    $selected = '';
                                                    if (isset($config) && $banner->id == $config->banner->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$banner->id' " . $selected . ">$banner->name </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Contenido de la ayuda de imágenes:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            foreach ($configRegions as $configRegion) {
                                                if ($configRegion->getRegion() == 'imagenHelp')
                                                    $config = $configRegion;
                                            }
                                            ?>
                                            <input type="hidden" name="['imagen']['imagenHelp']['type']" value="page">
                                            <select class="custom-select" name="['imagen']['imagenHelp']['contentId']"
                                                    placeholder="Seleccione contenido">
                                                <option value="0">Sin seleccionar</option>
                                                <?php
                                                foreach ($pages as $page) {
                                                    $selected = '';
                                                    if (isset($config) && $page->id == $config->page->id)
                                                        $selected = 'selected';
                                                    echo "<option value='$page->id' " . $selected . ">$page->title </option>";
                                                }
                                                $config = null;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
