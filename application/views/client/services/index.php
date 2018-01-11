<div id="listing-3" class="listing listing-3">
    <div class="row">
        <?php foreach ($services as $object) { ?>

            <div class="col-md-4">
                <div class="listing-grid listing-grid-1">
                    <div class="listing-heading">
                        <?php if ($object->professional == 1) { ?>
                            <div class="marker-ribbon">
                                <div class="ribbon-banner">
                                    <div class="ribbon-text">Profesional</div>
                                </div>
                            </div>
                        <?php } ?>
                        <h5><a href="<?= site_url("service/") . $object->getId() ?>"><?= $object->title ?></a></h5>
                    </div>
                    <div class="listing-inner">
                        <div class="flexslider default-slider">
                            <ul class="slides" style="position: relative">
                                <li class="flex-active-slide p-absolute"
                                    style="width: 100%; float: left; height: 100%; margin-right: -100%; opacity:1; display: block; z-index: 2;">
                                    <img style="height: 100%" src="<?= $object->icon ?>" alt="" draggable="false"></li>
                                <?php
                                $images = $object->getImages()->toArray();
                                foreach ($images as $image) {
                                    echo '<li class="p-absolute" style="width: 100%; float: left; height: 100%; margin-right: -100%; opacity: 0; display: block; z-index: 1;"><img src="' . $image->getTitle() . '" alt="" draggable="false"></li>';
                                }
                                ?>
                            </ul>
                            <div class="reviews">
                                <ul>
                                    <?php $rate = $object->getGlobalrate();

                                    for ($pos = 0; $pos < 5; $pos++) {
                                        if ($pos < $rate) {
                                            echo '<li><i class="fa fa-star"></i></li>';
                                        } else {
                                            echo ' <li><i class="fa fa-star-o"></i></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                                <span class="count"><?= $object->getReviews() ?> vistas</span>
                            </div>
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
                        <div class="info-footer">
                            <img height="20" width="20"
                                 src="<?= $object->getSubcategories()->toArray()[0]->getIcon() ?>">
                            <h6><?= $object->getSubcategories()->toArray()[0]->getTitle() ?></h6>
                            <i class="fa fa-bookmark bookmark pull-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!--*****************************************************************************************************************-->

<div id="listing-1" class="listing listing-1 hidden">
    <?php
    $pos = 0;

    foreach ($services as $object) {
        $pos++;
        ?>
        <div class="listing-ver-1">
            <div class="listing-heading">
                <h5><a href="single_business.html"><?= $object->title ?></a></h5>
                <?php if ($object->professional == 1) { ?>
                    <a href="#" class="c-red"><i class="fa fa-bookmark"></i></a>
                <?php } ?>
            </div>
            <div class="tab-content">
                <div id="basic<?= $pos ?>" class="tab-pane fade in active basic">
                    <div class="listing-inner">
                        <div class="flexslider default-slider">
                            <ul class="slides">
                                <li class="flex-active-slide"
                                    style="width: 100%; float: left; margin-right: -100%; position: relative; opacity:1; display: block; z-index: 2;">
                                    <img src="<?= $object->icon ?>" alt="" draggable="false"></li>
                                <?php
                                $images = $object->getImages()->toArray();
                                foreach ($images as $image) {
                                    echo '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="' . $image->getTitle() . '" alt="" draggable="false"></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="listing-content">
                      <span class="location">
                        <?= $object->subtitle ?>
                      </span>
                            <p><?= $object->description ?></p>
                        </div>
                    </div>
                </div>
                <div id="contact<?= $pos ?>" class="tab-pane fade in contact">
                    <div class="listing-inner">
                        <div class="map">
                            <div class="map-listing-04"></div>
                        </div>
                        <div class="listing-content">
                            <h6 class="main-title">Información adicional</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="contact">
                                        <li>
                                            <h6>Correo:</h6>
                                            <span><?= $object->email ?></span>
                                        </li>
                                        <li>
                                            <h6>Sitio web:</h6>
                                            <span><?= $object->url ?></span>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-arrows-alt"></i> View map in fullscreen</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="contact">
                                        <li>
                                            <h6>Teléfono:</h6>
                                            <span><?= $object->phone ?></span>
                                        </li>
                                        <li>
                                            <h6>Télefono adicional:</h6>
                                            <span><?= $object->other_phone ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="report<?= $pos ?>" class="tab-pane fade in report">
                    <div class="listing-inner">
                        <div class="listing-content">
                            <h6 class="main-title">Report / Claim Listing</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="custom-select">
                                        <option value="0" selected>Report Category</option>
                                        <option value="1">Prior</option>
                                        <option value="2">Standard</option>
                                    </select>
                                    <select class="custom-select">
                                        <option value="0" selected>Reasons for report</option>
                                        <option value="1">Illegal anons</option>
                                        <option value="2">Cheater employee</option>
                                    </select>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="message" placeholder="Your Message"></textarea>
                                    <input type="button" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="hours<?= $pos ?>" class="tab-pane fade in hours">
                    <div class="listing-inner">
                        <div class="listing-content">
                            <h6 class="main-title">Opening Hours</h6>
                            <div class="row">
                                <div class="col-md-5">
                                    <ul class="schedule">
                                        <li><span class="day">Monday</span> <span
                                                    class="hours">10:00 AM - 7:00 PM</span>
                                        </li>
                                        <li><span class="day">Tuesday</span> <span
                                                    class="hours">10:00 AM - 7:00 PM</span>
                                        </li>
                                        <li><span class="day">Wednesday</span> <span
                                                    class="hours">10:00 AM - 7:00 PM</span>
                                        </li>
                                        <li class="sunday"><span class="day">Sunday</span> <span
                                                    class="hours">Closed</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-5">
                                    <ul class="schedule">
                                        <li><span class="day">Thursday</span><span
                                                    class="hours">10:00 AM - 7:00 PM</span>
                                        </li>
                                        <li><span class="day">Friday</span><span class="hours">10:00 AM - 7:00 PM</span>
                                        </li>
                                        <li><span class="day">Saturday</span><span
                                                    class="hours">10:00 AM - 7:00 PM</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="listing-tabs">
                <ul>
                    <li class="active"><a href="#basic<?= $pos ?>" data-toggle="tab"><i class="fa fa-info"></i></a></li>
                    <li><a href="#contact<?= $pos ?>" data-toggle="tab"><i class="fa fa-envelope"></i></a></li>
                    <li><a href="#report<?= $pos ?>" data-toggle="tab"><i class="fa fa-flag"></i></a></li>
                    <li><a href="#hours<?= $pos ?>" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>

