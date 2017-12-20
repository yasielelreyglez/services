<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="restaurant" style=';'>
<div class="content-restaurant ">
	<div id="body" class="listing listing-1 ">
      <?php  foreach ($pagos as $pago) { ?>
        <div class="listing-ver-6">
            <div class="listing-heading">
                <h5><a href='<?=site_url('admin/services/show/').$pago->getService()->id?>'> <?=$pago->getService()->getTitle()?></a></h5>
                <a href="<?=site_url('admin/pagos/eliminar/'.$pago->id)?>"><i class="fa fa-remove"></i></a>
            </div>
            <div class="listing-inner">
                <?php if($pago->getType()==1) { ?>
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
                }else{
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
                    <h6 class="title-company"><i class="fa fa-credit-card-alt  "></i><?= $pago->getTypeString()?></h6>
                         <?php if($pago->getType()!=1) { ?>
                             <i class="fa fa-info-circle"></i><span><?=$pago->country?></span></>
                             <i class="fa fa-phone"></i><span><?=$pago->phone?></span></li>
                             <?php
                         }
              ?>
                    <span class="location">
                    <i class="fa fa-user"></i>
                    <?=$pago->getService()->getAuthor()->getUsername()?>
                  </span>
                    <ul class="more-info list-inline">
                        <li class="info info-reviews">
                            <ul class="rate list-inline">
                                <?php $rate = $pago->getService()->getGlobalrate();

                                for ($pos = 0;$pos<10;$pos++){
                                    if($pos<$rate){
                                        echo'<li><i class="fa fa-star "></i></li>';
                                    }else{
                                        echo ' <li><i class="fa fa-star-o"></i></li>';
                                    }
                                }
                                        ?>
                            </ul>
                            <span class="count"><?=$pago->getService()->getReviews()?> reviews</span>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <ul class="contact">
                                <li><i class="fa fa-compass"></i><span><?=$pago->getMembership()->getTitle()?></span></li>
                                <li><i class="fa fa-usd"></i><span>$<?=$pago->getMembership()->getPrice()?> - <?=$pago->getMembership()->getDays()?> dias</span></li>
                                <li><i class="fa fa-clock-o"></i><span><?=$pago->getCreatedAt()->format('d-M h:i')?></span></li>
                            </ul>
                        </div>
                    </div>
                    <h6 class="title-tags">Acciones:</h6>
                    <?php if($pago->getState()==0){?>
                    <ul class="list-inline">
                        <li class="btn btn-medium btn-transparent-primary"><?=anchor('admin/pagos/aceptar/'.$pago->id, 'Aceptar pago','class=\"btn btn-info\" method=\"get\"')?></li>
                        <li class="btn btn-medium btn-transparent-invert"><?=anchor('admin/pagos/denegar/'.$pago->id, 'Denegar pago','class=\"btn btn-info\" method=\"get\"')?></li>
                    </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
       <?php }?>
<!--	<table class="table table-striped table-bordered">-->
<!--        <thead>-->
<!--            <th>Servicio</th>-->
<!--            <th>Membresia</th>-->
<!--            <th>Tipo pago</th>-->
<!--            <th>Evidencia</th>-->
<!--            <th>Pais</th>-->
<!--            <th>Telefono</th>-->
<!--            <th>Estado</th>-->
<!--            <th>Aceptar</th>-->
<!--            <th>Denegar</th>-->
<!--            <th>Eliminar</th>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php
//
//        foreach ($pagos as $pago){
//            if($pago->getMembership()){
//                $memb ="<td>{$pago->getMembership()->getTitle()}</td>";
//            }else {
//                $memb = "  <td></td>";
//            }
//
//            echo "<tr>
//                        <td><a href='".site_url('admin/services/show/').$pago->getService()->id."'>".$pago->getService()->getTitle()."</a> </td>
//                        $memb
//
//                        <td>{$pago->getTypeString()}</td>
//                        <td><img src='".$pago->getEvidence()."' height='50px' width='50px'></td>
//                        <td>{$pago->getCountry()}</td>
//                        <td>{$pago->getPhone()}</td>
//                        <td>{$pago->getStateString()}</td>
//                       ";
//            if($pago->getState()==0){
//                echo " <td width=\"80\">".anchor('admin/pagos/aceptar/'.$pago->id, 'Aceptar pago','class=\"btn btn-info\" method=\"get\"')."</td>
//                        <td width=\"80\">".anchor('admin/pagos/denegar/'.$pago->id, 'Denegar pago','class=\"btn btn-info\" method=\"get\"')."</td>
//                        <td width=\"80\">".anchor('admin/pagos/eliminar/'.$pago->id, 'Eliminar pago','class=\"btn btn-info\" method=\"get\"')."</td>
//                ";
//            }
//            echo "</tr>";
//        }
//        ?>
<!--        </tbody>-->
<!--    </table>-->
    </div>
</div>
</div>