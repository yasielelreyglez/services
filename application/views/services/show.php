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
<div class="col-md-9">
    <div class="listing listing-1 single-listing">
        <div class="listing-ver-1">
            <div class="listing-heading">
                <div class="reviews">
                    <ul class="rate">
                        <?php $rate = $services->getGlobalrate();
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
                    <h5><?= $services->title ?></h5>
                    <?php if ($services->professional == 1) { ?>
                        <a href="#" class="c-red"><i class="fa fa-bookmark"></i></a>
                    <?php } ?>

            </div>

            <div class="listing-tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#basic" data-toggle="tab" aria-selected="true"><i
                                    class="fa fa-info"></i></a></li>
                    <li><a href="#moreinfo" data-toggle="tab"><i class="fa fa-plus"></i></a></li>
                    <li><a href="#contact" data-toggle="tab"><i class="fa fa-map-marker"></i></a></li>
                    <li><a href="#hours" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="basic" class="tab-pane active" role="tabpanel" aria-labelledby="home-tab">
                    <div class="listing-inner" style="min-height: 420px;">
                        <div class="listing-content">
                            <div class="listing-content-inner">
&nbsp;
<!--                                </div>-->
                                <div class="flexslider default-slider">
                                    <ul class="slides">

                                        <?php
                                        $images = $services->getImages()->toArray();
                                        foreach ($images as $image) {
                                            echo '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="' . site_url() . $image->getTitle() . '" alt="" draggable="false"></li>';
                                        }
                                        ?>
                                    </ul>

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
                                <div class="listing-content-description margin-description">
                                    <p><?= $services->subtitle ?></p>
                                    <p></p>
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
                        <div class="map">
                            <h6>Mis ubicaciones:</h6>
                            <div class="map-listing-04"></div>
                        </div>
                    </div>
                </div>
                <div id="hours" class="tab-pane hours">
                    <div class="listing-inner">
                        <div class="listing-content">
                            <h6 class="main-title">Horarios:</h6>
                            <div class="row">
                                <div class="col-md-5">
                                    <ul class="schedule">
                                        <?php foreach ($times as $time): ?>
                                            <li>
                                            <span class="day">
                                                <?php
                                                foreach (explode(',', $time->week_days) as $key => $day) {
                                                    echo $key + 1 == count(explode(',', $time->week_days)) ? $week_days[$day] : $week_days[$day] . ',';
                                                } ?>
                                            </span>
                                                <span class="hours"><?php print_r($time->start_time); ?>
                                                    - <?php print_r($time->end_time); ?></span>
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
    <div class="advertiser-info">
        <div class="advertiser-header">
            <h5>Comentarios</h5>
        </div>
        <div class="advertiser-inner">
            <div class="row">
                <div id="comments" class="ng-star-inserted">
                    <?php foreach($comments as $comment):?>
                    <div class="">
                        <div>
                            <span class="showrate"><li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star-o"></i></li> <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                            </span>
                        </div>
                        <div>
                            <p class="tc-grei" style="word-wrap: break-word !important;">
                               <?php echo $comment->comment;?>
                            </p>
                            <div>
                                <td width="80"><?= anchor('admin/services/edit/' . $services->id, '<i class="fa fa-microphone"></i>', 'class="btn btn-danger"'); ?></td>
                                <td width="80"><?= anchor('admin/services/edit/' . $services->id, '<i class="fa fa-check" aria-hidden="true"></i>', 'class="btn btn-success"'); ?></td>
                            </div>
                            <hr class="bc-grei">
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>