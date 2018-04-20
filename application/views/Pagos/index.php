<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="header-listing">
    <ul class="listing-views">
        <li><a name="listview" href="#"><i class="fa fa-list"></i></a></li>
        <li class="active"><a name="gridview" href="#"><i class="fa fa-th"></i></a></li>
    </ul>
</div>
<div id="body" class="listing listing-1 ">
    <div class="container">
        <div class="row gridview">
            <?php /** @var TYPE_NAME $pagos */
            foreach ($pagos as $pago) { ?>
                <div class="listing-ver-6 element">
                    <div class="listing-heading">
                        <h5>
                            <a href='<?= site_url('admin/services/show/') . $pago->getService()->id ?>'> <?= $pago->getService()->getTitle() ?></a>
                        </h5>
                        <a href="<?= site_url('admin/pagos/eliminar/' . $pago->id) ?>" class="destroy"><i class="fa fa-remove"></i></a>
                    </div>
                    <div class="listing-inner">
                        <?php if ($pago->getType() == 1) { ?>
                            <div class="flexslider default-slider">
                                <ul class="slides">
                                    <li class=""
                                        style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
                                        <img src="<?= $pago->getEvidence() ?>" alt="" draggable="false"></li>
                                </ul>
                                <ol class="flex-control-nav flex-control-paging">
                                    <li><a class="">1</a></li>
                                    <li><a class="flex-active">2</a></li>
                                </ol>
                                <ul class="flex-direction-nav">
                                    <li><a class="flex-prev" href="#"></a></li>
                                    <li><a class="flex-next" href="#"></a></li>
                                </ul>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="flexslider default-slider">
                                <ul class="slides">
                                    <li class=""
                                        style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
                                        <img src="<?= $pago->getService()->getIcon() ?>" alt="" draggable="false"></li>
                                </ul>
                                <ol class="flex-control-nav flex-control-paging">
                                    <li><a class="">1</a></li>
                                    <li><a class="flex-active">2</a></li>
                                </ol>
                                <ul class="flex-direction-nav">
                                    <li><a class="flex-prev" href="#"></a></li>
                                    <li><a class="flex-next" href="#"></a></li>
                                </ul>
                            </div>
                        <?php }
                        ?>
                        <div class="listing-content">
                            <h6 class="title-company"><i
                                        class="fa fa-credit-card-alt  "></i><?= $pago->getTypeString() ?></h6>
                            <ul class="contact">
                                <?php if ($pago->getType() != 1) { ?>
                                    <li><i class="fa fa-info-circle"></i> Nombre:<span class="element-title"><?= $pago->nombre ?></span></li>
                                    <li><i class="fa fa-phone"></i>Numero:<span><?= $pago->numero ?></span></li>
                                    <li><i class="fa fa-phone"></i>CVV:<span><?= $pago->cvv ?></span></li>
                                    <li><i class="fa fa-phone"></i>Caduca:<span><?= $pago->caducidad ?></span></li>

                                    <?php
                                }
                                ?>
                            </ul>
                            <span class="location">
                                <i class="fa fa-user"></i>
                                            <?= $pago->getService()->getAuthor()->getUsername() ?>
                              </span>

                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <ul class="contact">
                                        <li>
                                            <i class="fa fa-compass"></i><span><?= $pago->getMembership()->getTitle() ?></span>
                                        </li>
                                        <li><i class="fa fa-usd"></i><span>$<?= $pago->getMembership()->getPrice() ?>
                                                - <?= $pago->getMembership()->getDays() ?> dias</span></li>
                                        <li>
                                            <i class="fa fa-clock-o"></i><span><?= $pago->getCreatedAt()->format('d-M h:i') ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <h6 class="title-tags">Acciones:</h6>
                            <?php if ($pago->getState() == 0) { ?>
                                <ul class="list-inline">
                                    <li class="btn btn-medium btn-transparent-primary"><?= anchor('admin/pagos/aceptar/' . $pago->id, 'Aceptar pago', 'class=\"btn btn-info\" method=\"get\"') ?></li>
                                    <li class="btn btn-medium btn-transparent-invert"><?= anchor('admin/pagos/denegar/' . $pago->id, 'Denegar pago', 'class=\"btn btn-info\" method=\"get\"') ?></li>
                                </ul>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="row listview hide">
            <table class="table">
                <thead>
                <th>#</th>
                <th>Nombre</th>
                <th>Servicio</th>
                <th>Membresia</th>
                <th>Tipo pago</th>
                <!--        <th>Evidencia</th>-->
                <th>Pais</th>
                <!--        <th>Telefono</th>-->
                <th>Estado</th>
                <th colspan="3"></th>
                </thead>
                <tbody>
                <?php foreach ($pagos as $pago): ?>
                    <tr class="element">
                        <td><?php echo $pago->id; ?></td>
                        <td>
                            <a href="<?php echo site_url('admin/pagos/show/') . '' . $pago->id ?>" class="element-title"> <?php echo $pago->getNombre(); ?>                    </a>
                        <td>
                            <a href="<?php echo site_url('admin/services/show/') . '' . $pago->getService()->id ?>"> <?php echo $pago->getService()->getTitle(); ?>                    </a>
                        </td>
                        <?php if ($pago->getMembership()): ?>
                            <td><?php echo $pago->getMembership()->getTitle(); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                        <td><?php echo $pago->getTypeString(); ?></td>
                        <!--            <td>-->
                        <!--                --><?php //if(!empty($pago->getEvidence())):?>
                        <!--                <img src=" -->
                        <?php //echo $pago->getEvidence();?><!--" height='50px' width='50px'>-->
                        <!--                --><?php //endif;?>
                        <!--            </td>-->
                        <td><?php echo $pago->getCountry(); ?></td>
                        <!--            <td>--><?php //echo $pago->getPhone();?><!--</td>-->
                        <td><?php echo $pago->getStateString(); ?></td>
                        <?php if ($pago->getState() == 0): ?>
                            <td width=\"80\"><?= anchor('admin/pagos/aceptar/' . $pago->id, 'Aceptar', 'class="btn btn-info"'); ?></td>
                            <td width=\"80\"><?= anchor('admin/pagos/denegar/' . $pago->id, 'Denegar', 'class="btn btn-warning"'); ?></td>
                            <td width=\"80\"><?= anchor('admin/pagos/eliminar/' . $pago->id, 'Eliminar', 'class="btn btn-danger destroy"'); ?></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>