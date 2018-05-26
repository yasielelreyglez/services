<div class="header-listing">
    <ul class="listing-views">
        <li><a name="listview" href="#"><i class="fa fa-list"></i></a></li>
        <li class="active"><a name="gridview" href="#"><i class="fa fa-th"></i></a></li>
    </ul>
</div>

<div class="listing listing-3 listing-variation">

    <div class="container">
        <div class="row listview hide">
            <table class="table">
                <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Queja</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                <?php if (!count($complaints)) : ?>
                    <tr>
                        <td colspan="6">No hay servicios denunciados.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($complaints as $object) : ?>
                        <tr class="element">
                            <td>
                                <a href="<?= site_url('admin/services/show/') . $object->getService()->id ?>" class="element-title"> <?= $object->getService()->getTitle() ?></a>
                            </td>
                            <td><?= $object->complaint ?></td>
                            <td><?= $object->complaint_created->format('Y-m-d H:i:s') ?></td>
                            <td><?= $object->getUser()->getUsername(); ?></td>

                            <td width="80"><?= anchor('admin/services/edit/' . $object->getService()->id, 'Editar', 'class="btn btn-warning"'); ?></td>
                            <td width="80"><?= anchor('admin/services/quitarQueja/' . $object->getService()->id . '/'. $object->getUser()->id , 'Eliminar', 'class="btn btn-danger destroy"'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="row gridview">
            <?php if (!count($complaints)) : ?>
                No hay servicios denunciados.
            <?php endif; ?>
            <?php foreach ($complaints as $object) : ?>
                <div class="col-md-4 listing-grid listing-grid-2 element">
                    <div class="listing-heading">
                        <?php if ($object->getService()->getProfessional() == 1) { ?>
                            <div class="marker-ribbon">
                                <div class="ribbon-banner">
                                    <div class="ribbon-text">Profesional</div>
                                </div>
                            </div>
                        <?php } ?>
                        <h5 class="element-title"><?= $object->getService()->getTitle() ?></h5>
                    </div>
                    <div class="listing-inner">
                        <div class="flexslider default-slider">
                            <ul class="slides">
                                <li class="flex-active-slide"
                                    style="width: 100%; float: left; margin-right: -100%; position: relative; opacity:1; display: block; z-index: 2;">
                                    <img src="<?= site_url() . $object->getService()->getThumb() ?>" alt="" draggable="false"></li>
                                <?php
                                $images = $object->getService()->getImages()->toArray();
                                foreach ($images as $image) {
                                    echo '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="' . site_url() .  $image->getTitle() . '" alt="" draggable="false"></li>';
                                }
                                ?>
                            </ul>
                            <div class="reviews">
                                <ul class="">
                                    <?php $rate = $object->getService()->getGlobalrate();

                                    for ($pos = 0; $pos < 10; $pos++) {
                                        if ($pos < $rate) {
                                            echo '<li><i class="fa fa-star "></i></li>';
                                        } else {
                                            echo ' <li><i class="fa fa-star-o"></i></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                                <span class="count"><?= $object->getService()->getReviews() ?> reviews</span>
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
                            <li class="">
                                <a href="#"><i class="fa fa-info main-icon"></i> Información</a>
                                <div>
                                    <h5 class="title"><?= $object->getService()->subtitle ?></h5>
                                    <p><?= $object->getService()->description ?></p>
                                </div>
                            </li>
                            <li class="">
                                <a href="#"><i class="fa fa-envelope main-icon"></i> Información adicional</a>
                                <div>
                                    <ul class="contact-info list-unstyled mb0">

                                        <?php if ($object->getService()->address) { ?>
                                            <li><i class="fa fa-map-marker"></i> <?= $object->getService()->address ?>
                                            </li><?php } ?>
                                        <?php if ($object->getService()->email) { ?>
                                            <li><i class="fa fa-envelope-o"></i> <?= $object->getService()->email ?>
                                            </li><?php } ?>
                                        <?php if ($object->getService()->url) { ?>
                                            <li><i class="fa fa-globe"></i><?= $object->getService()->url ?>
                                            </li><?php } ?>
                                        <?php if ($object->getService()->phone) { ?>
                                            <li><i class="fa fa-phone"></i><?= $object->getService()->phone ?>
                                            </li><?php } ?>
                                        <?php if ($object->getService()->other_phone) { ?>
                                            <li><i class="fa fa-fax"></i> <?= $object->getService()->other_phone ?>
                                            </li> <?php } ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="active">
                                <a href="#"><i class="fa fa-bullhorn main-icon"></i> Queja</a>
                                <div>
                                    <ul class="contact-info list-unstyled mb0">

                                        <?php if ($object->complaint) : ?>
                                            <?= $object->complaint ?>
                                        <?php endif; ?>
                                        <?php if ($object->getUser()) : ?>
                                            <li><i class="fa fa-user"></i> <?= $object->getUser()->getUsername() ?></li>
                                        <?php endif; ?>
                                        <?php if ($object->complaint_created) : ?>
                                            <li>
                                                <i class="fa fa-calendar"></i> <?= $object->complaint_created->format('Y-m-d H:i:s') ?>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </li>
                        </ul> <!-- end .uou-accordions -->
                    </div>
                    <div class="info-footer">
                        <?php
                        $subcats = $object->getService()->getSubcategories()->toArray();
                        if(is_array($subcats)&&count($subcats)>0){
                            $subcat = $subcats[0];

                        ?>

                            <img height="20" width="20"

                                 src="<?= $object->getService()->getSubcategories()->toArray()[0]->getIcon() ?>">
                            <h6><?= $object->getService()->getSubcategories()->toArray()[0]->getTitle() ?></h6>
                            <a class="pull-right pl10 destroy" title="Destruir servicio"
                               href="<?= site_url('admin/services/destroy/') . $object->getService()->id ?>"><i
                                        class="fa fa-trash bookmark"></i></a>
                        <?php } ?>
                        <a class="pull-right pl10" title="Editar servicio"
                           href="<?= site_url('admin/services/edit/') . $object->getService()->id ?>"><i
                                    class="fa fa-edit bookmark"></i></a>
                        <a class="pull-right" title="Ver servicio"
                           href="<?= site_url('admin/services/show/') . $object->getService()->id ?>"><i
                                    class="fa fa-eye bookmark"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>