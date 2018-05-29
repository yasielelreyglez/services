<?php
$week_days = array(
    'Lunes',
    'Martes',
    'Miercoles',
    'Jueves',
    'Viernes',
    'Sabado',
    'Domingo',
);
?>
<div class="col-xs-12">
    <div class="listing listing-1 single-listing showing">
        <div class="listing-ver-1">
            <div class="listing-heading">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <h5><?= $services->title ?></h5>
                        <?php if ($services->professional == 1) { ?>
                            <span class="c-red" href="#">(PRO)</span>
                        <?php } ?>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <ul class="showrate pull-right">
                            <?php $rate = $services->getGlobalrate();
                            for ($pos = 0; $pos < 10; $pos++) {
                                if ($pos < $rate) {
                                    echo ' <li><i class="fa fa-star "></i></li>';
                                } else {
                                    echo ' <li><i class="fa fa-star-o"></i></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="listing-tabs">
                <ul>
                    <li class="active tab"><a href="#basic" data-toggle="tab" aria-selected="true"><i
                                    class="fa fa-info"></i></a></li>
                    <li class="tab"><a href="#moreinfo" data-toggle="tab"><i class="fa fa-plus"></i></a></li>
                    <li class="tab"><a href="#contact" data-toggle="tab"><i class="fa fa-map-marker"></i></a></li>
                    <li class="tab"><a href="#hours" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="basic" class="tab-pane active" role="tabpanel" aria-labelledby="home-tab">
                    <div class="listing-inner" style="">
                        <div class="listing-content">
                            <div class="listing-content-inner">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        &nbsp;
                                        <div class="flexslider default-slider">
                                            &nbsp;
                                            <ul class="slides">
                                                &nbsp;
                                               <?php
                                                $images = $services->getImages()->toArray();
                                                foreach ($images as $image) {
                                                    echo '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="' .site_url() . $image->getThumb() . '" alt="" draggable="false"></li>';
                                                }
                                                ?>
                                            </ul>
                                            <ul class="flex-direction-nav">
                                                <li><a class="flex-prev" href="#"></a></li>
                                                <li><a class="flex-next" href="#"></a></li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="listing-content-description margin-description">
                                            <p><?= $services->subtitle ?></p>
                                            <p><?= $services->description ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="moreinfo" class="tab-pane " role="tabpanel" aria-labelledby="moreinfo-tab">
                    <div class="listing-inner">
                        <div class="listing-content">
                            <h6 class="main-title">Información adicional</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="contact">
                                        <li>
                                            <h6>Correo:</h6>
                                            <span><?= $services->email ?></span>
                                        </li>
                                        <li>
                                            <h6>Sitio web:</h6>
                                            <span><?= $services->url ?></span>
                                        </li>
                                        <li>
                                            <h6>Dirección:</h6>
                                            <span><?= $services->address ?></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="contact">
                                        <li>
                                            <h6>Teléfono:</h6>
                                            <span><?= $services->phone ?></span>
                                        </li>
                                        <li>
                                            <h6>Télefono adicional:</h6>
                                            <span><?= $services->other_phone ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="contact" class="tab-pane " role="tabpanel" aria-labelledby="contact-tab">
                    <div class="listing-inner">
                        <div class="listing-content">
                            <h6 class="main-title">Mis ubicaciones:</h6>
                            <div class="map">
                                <div class="map-listing-04"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="hours" class="tab-pane hours">
                    <div class="listing-inner">
                        <div class="listing-content">
                            <h6 class="main-title">Horarios:</h6>
                            <div class="row">
                                <div class="col-xs-12">
                                    <ul class="schedule">
                                        <?php foreach ($times as $time): ?>
                                            <li>
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-6">
                                                        <span class="day">
                                                            <?php
                                                            foreach (explode(',', $time->week_days) as $key => $day) {
                                                                echo $key + 1 == count(explode(',', $time->week_days)) ? $week_days[$day] : $week_days[$day] . ', ';
                                                            } ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-xs-12 col-md-6">
                                                        <span class="hours"><?php //print_r($time->start_time); ?>
                                                            - <?php //print_r($time->end_time); ?></span>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="advertiser-info comment">
        <div class="advertiser-header">
            <h5>Comentarios</h5>
        </div>
        <div class="advertiser-inner">
            <div class="row">
                <div id="comments" class="ng-star-inserted">
                    <?php foreach ($serviscesUsers as $comment): ?>
                    <?php if ($comment->getRatecomment()) : ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <h6>
                                    <?php echo $comment->getUser()->getUsername(); ?>
                                </h6>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <ul class="showrate pull-right">
                                    <?php $rate = $comment->getRate();

                                    for ($pos = 0; $pos < 10; $pos++) {
                                        if ($pos < $rate) {
                                            echo '<li><i class="fa fa-star "></i></li>';
                                        } else {
                                            echo ' <li><i class="fa fa-star-o"></i></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="col-xs-12">
                                <p class="tc-grei" style="word-wrap: break-word !important;">
                                    <?php echo $comment->getRatecomment(); ?>
                                </p>
                                <div class="pull-right">
                                    <?= anchor('admin/services/edit/' . $services->id, '<i class="fa fa-microphone"></i>', 'class="btn btn-danger"'); ?>
                                    <?= anchor('admin/services/edit/' . $services->id, '<i class="fa fa-check" aria-hidden="true"></i>', 'class="btn btn-success"'); ?>
                                </div>
                            </div>
                        </div>
                        <hr class="bc-grei">
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <>
    <div class="advertiser-info comment">
        <div class="advertiser-header">
            <h5>Quejas</h5>
        </div>
        <div class="advertiser-inner">
            <div class="row">
                <div class="ng-star-inserted">
                    <?php foreach ($complaints as $serviscesUser): ?>
                    <?php if($serviscesUser->getComplaint()!=null):?>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <h6>
                                    <?php echo $serviscesUser->getUser()->getUsername(); ?>
                                </h6>
                                <p>
                                    <i class="fa fa-calendar"></i><?= ($serviscesUser->getComplaintCreated()!=null)? $serviscesUser->getComplaintCreated()->format('d-M h:i'): ''; ?>
                                </p>
                            </div>
                            <div class="col-xs-12">
                                <p class="tc-grei" style="word-wrap: break-word !important;">
                                    <?php echo $serviscesUser->getComplaint(); ?>
                                </p>
                                <div class="pull-right">
                                    <?= anchor('admin/services/edit/' . $services->id, '<i class="fa fa-microphone"></i>', 'class="btn btn-danger"'); ?>
                                    <?= anchor('admin/services/edit/' . $services->id, '<i class="fa fa-check" aria-hidden="true"></i>', 'class="btn btn-success"'); ?>
                                </div>
                            </div>
                        </div>
                        <hr class="bc-grei">
                        <?php endif;?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>