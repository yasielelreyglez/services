<div class="header-listing">
    <ul class="listing-views">
        <li><a name="listview" href="#"><i class="fa fa-list"></i></a></li>
        <li class="active"><a name="gridview" href="#"><i class="fa fa-th"></i></a></li>
    </ul>
</div>

<div class="listing listing-3 listing-variation">

    <div class="container">
        <div class="row gridview">
            <?php if (!count($services)) : ?>
                No hay servicios creados.
            <?php endif; ?>
            <?php foreach ($services as $object) { ?>
                <div class="col-md-4 listing-grid listing-grid-2 element">
                    <div class="listing-heading">
                        <?php if ($object->professional == 1) { ?>
                            <div class="marker-ribbon">
                                <div class="ribbon-banner">
                                    <div class="ribbon-text">Profesional</div>
                                </div>
                            </div>
                        <?php } ?>
                        <h5 class="element-title"><?= $object->title ?></h5>
                    </div>
                    <div class="listing-inner">
                        <div class="flexslider default-slider">
                            <ul class="slides">
                                <li class="flex-active-slide"
                                    style="width: 100%; float: left; margin-right: -100%; position: relative; opacity:1; display: block; z-index: 2;">
                                    <img src="<?= site_url().$object->icon ?>" alt="" draggable="false"></li>
                                <?php
                                $images = $object->getImages()->toArray();
                                foreach ($images as $image) {
                                    echo '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="'. site_url() . $image->getTitle() . '" alt="" draggable="false"></li>';
                                }
                                ?>
                            </ul>
                            <div class="reviews">
                                <ul class="rate">
                                    <?php $rate = $object->getGlobalrate();

                                    for ($pos = 0; $pos < 10; $pos++) {
                                        if ($pos < $rate) {
                                            echo '<li><i class="fa fa-star "></i></li>';
                                        } else {
                                            echo ' <li><i class="fa fa-star-o"></i></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                                <span class="count"><?= $object->getReviews() ?> reviews</span>
                            </div>
                            <ol class="flex-control-nav flex-control-paging">
                                <li><a class="">1</a></li>
                                <li><a class="flex-active">2</a></li>
                                <li><a class="">3</a></li>
                                <li><a class="">4</a></li>
                            </ol>
                            <ul class="flex-direction-nav">
                                <li><a class="flex-prev" href="#"></a></li>
                                <li><a class="flex-next" href="#"></a></li>
                            </ul>
                        </div>
                        <ul class="uou-accordions">
                            <li class="active">
                                <a href="#"><i class="fa fa-info main-icon"></i> Información</a>
                                <div>
                                    <h5 class="title"><?= $object->subtitle ?></h5>
                                    <p><?= $object->description ?></p>
                                </div>
                            </li>
                            <li class="">
                                <a href="#"><i class="fa fa-envelope main-icon"></i> Información adicional</a>
                                <div>
                                    <ul class="contact-info list-unstyled mb0">

                                        <?php if ($object->address) { ?>
                                            <li><i class="fa fa-map-marker"></i> <?= $object->address ?></li><?php } ?>
                                        <?php if ($object->email) { ?>
                                            <li><i class="fa fa-envelope-o"></i> <?= $object->email ?></li><?php } ?>
                                        <?php if ($object->url) { ?>
                                            <li><i class="fa fa-globe"></i><?= $object->url ?></li><?php } ?>
                                        <?php if ($object->phone) { ?>
                                            <li><i class="fa fa-phone"></i><?= $object->phone ?></li><?php } ?>
                                        <?php if ($object->other_phone) { ?>
                                            <li><i class="fa fa-fax"></i> <?= $object->other_phone ?></li> <?php } ?>
                                    </ul>
                                </div>
                            </li>
                        </ul> <!-- end .uou-accordions -->
                    </div>
                    <div class="info-footer">
                        <img height="20" width="20" src="<?= $object->getSubcategories()->toArray()[0]->getIcon() ?>">
                        <h6><?= $object->getSubcategories()->toArray()[0]->getTitle() ?></h6>
                        <a class="pull-right pl10 destroy" title="Destruir"
                           href="<?= site_url('admin/services/destroy/') . $object->id ?>"><i
                                    class="fa fa-trash bookmark"></i></a>
                        <a class="pull-right pl10" title="Editar"
                           href="<?= site_url('admin/services/edit/') . $object->id ?>"><i
                                    class="fa fa-edit bookmark"></i></a>
                        <a class="pull-right" title="Ver"
                           href="<?= site_url('admin/services/show/') . $object->id ?>"><i
                                    class="fa fa-eye bookmark"></i></a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?= anchor('admin/services/create/', '+', 'class="floating-button" title="Crear servicio"'); ?>
        <div class="row listview hide">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Direcci&oacute;n</th>
                    <th>&Iacute;cono</th>
                    <th>Email</th>
                    <th>Url</th>
                    <th>Tel&eacute;fono</th>
                    <th colspan="2">Acciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!count($services)) : ?>
                    <tr>
                        <td colspan="9">No hay servicios creados.</td>
                    </tr>
                <?php endif; ?>
                <?php foreach ($services as $key=> $object) : ?>
                    <tr class="element">
                        <td>
                            <?= $object->id ?>
                        </td>
                        <td>
                            <a href="<?= site_url('admin/services/show/') . $object->id ?>" class="element-title"> <?= $object->title ?></a>
<!--                            --><?php //if ($object->professional == 1) : ?>
<!--                                <i class="fa fa-certificate" title="PROFESSIONAL"></i>-->
<!--                            --><?php //endif; ?>
                        </td>
                        <td>
                            <?php if ($object->address) : ?>
                                <?= $object->address ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <img height="20" width="20"
                                 src="<?= $object->getSubcategories()->toArray()[0]->getIcon() ?>">
                        </td>
                        <td>
                            <?php if ($object->email) : ?>
                                <?= $object->email ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($object->url) : ?>
                                <?= $object->url ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($object->phone) : ?>
                                <?= $object->phone ?>
                            <?php endif; ?>
                        </td>
                        <td width="80"><?= anchor('admin/services/edit/' . $object->id, 'Editar', 'class="btn btn-warning"'); ?></td>
                        <td width="80"><?= anchor('admin/services/destroy/' . $object->id, 'Eliminar', 'class="btn btn-danger destroy"'); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= anchor('admin/services/create', 'Crear', 'class="btn btn-primary"'); ?>
        </div>
    </div>
</div>