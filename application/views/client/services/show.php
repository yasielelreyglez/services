<div class="main-content content-business single-business has-bg-image" data-bg-color="f5f5f5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="listing listing-1 single-listing">
                    <div class="listing-ver-1">
                        <div class="listing-heading">
                            <h5><?= $object->title ?></h5>
                            <?php if ($object->professional == 1) {
//                                $object = new \Entities\Service();
                                ?>
                                <a href="#" class="c-red"><i class="fa fa-bookmark"></i></a>
                            <?php } ?>
                        </div>
                        <div class="listing-tabs">
                            <ul>
                                <li class="active"><a href="#basic" data-toggle="tab"><i class="fa fa-info"></i></a>
                                </li>
                                <li><a href="#contact" data-toggle="tab"><i class="fa fa-map-marker"></i></a></li>
                                <li><a href="#report" data-toggle="tab"><i class="fa fa-comments"></i></a></li>
                                <li><a href="#hours" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="basic" class="tab-pane fade in active basic-single">
                                <div class="listing-inner" style="min-height: 420px;">
                                    <div class="listing-content">
                                        <!--                                        <span class="location">-->
                                        <!--                                            <i class="fa fa-map-marker"></i> Manhattan, New York, USA-->
                                        <!--                                        </span>-->
                                        <div class="listing-content-inner">
                                            <div class="listing-content-thumbnail">
                                                <img src="<?= $object->icon ?>" alt="">
                                            </div>
                                            <div class="listing-content-description margin-description">
                                                <p><?= $object->description ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="contact" class="tab-pane fade in contact">
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
                                                        <a href="#"><i class="fa fa-arrows-alt"></i> View map in
                                                            fullscreen</a>
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
                            <div id="report" class="tab-pane fade in report">
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
                            <div id="hours" class="tab-pane fade in hours">
                                <div class="listing-inner">
                                    <div class="listing-content">
                                        <h6 class="main-title">Opening Hours</h6>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <ul class="schedule">
                                                    <li><span class="day">Monday</span> <span class="hours">10:00 AM - 7:00 PM</span>
                                                    </li>
                                                    <li><span class="day">Tuesday</span> <span class="hours">10:00 AM - 7:00 PM</span>
                                                    </li>
                                                    <li><span class="day">Wednesday</span> <span class="hours">10:00 AM - 7:00 PM</span>
                                                    </li>
                                                    <li class="sunday"><span class="day">Sunday</span> <span
                                                                class="hours">Closed</span></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-5">
                                                <ul class="schedule">
                                                    <li><span class="day">Thursday</span><span class="hours">10:00 AM - 7:00 PM</span>
                                                    </li>
                                                    <li><span class="day">Friday</span><span class="hours">10:00 AM - 7:00 PM</span>
                                                    </li>
                                                    <li><span class="day">Saturday</span><span class="hours">10:00 AM - 7:00 PM</span>
                                                    </li>
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
                        <h5>About the Advertiser</h5>
                    </div>
                    <div class="advertiser-inner">
                        <div class="row">
                            <div class="col-md-7 col-sm-7 advertiser-personal">
                                <div class="advertiser-thumbnail">
                                    <img src="<?= site_url("/resources/img/advertiser-thumbnail.png") ?>" alt="">
                                </div>
                                <div class="advertiser-details">
                                    <h5 class="name">Juan De La Cruz</h5>
                                    <span class="location">36 Years Old - Sydney, AU</span>
                                    <ul>
                                        <li><span>Tel: (123) 123-4567</span></li>
                                        <li><span>Website: example.com</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5 advertiser-contact text-right">
                                <ul class="social">
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                                <a href="#" class="btn btn-medium btn-transparent-primary">Send a message</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="sidebar-listing">
                    <h5 class="sidebar-listing-title">Similar Listings</h5>
                    <div class="listing-offer">
                        <h6 class="title"><a href="#">Urban Escape Spa</a></h6>
                        <div class="listing-offer-thumbnail">
                            <img src="<?= site_url("/resources/img/listing-offer-thumbnail1.png") ?>" alt="">
                        </div>
                        <div class="listing-offer-content">
                            <span class="location"><i class="fa fa-map-marker"></i> Manila, Philippines</span>
                            <ul class="rate">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <span class="count">208 reviews</span>
                        </div>
                    </div>
                    <div class="listing-offer">
                        <h6 class="title"><a href="#">Shear Studio</a></h6>
                        <div class="listing-offer-thumbnail">
                            <img src="<?= site_url("/resources/img/listing-offer-thumbnail2.png") ?>" alt="">
                        </div>
                        <div class="listing-offer-content">
                            <span class="location"><i class="fa fa-map-marker"></i> Dhaka, Bangladesh</span>
                            <ul class="rate">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <span class="count">208 reviews</span>
                        </div>
                    </div>
                    <div class="listing-offer">
                        <h6 class="title"><a href="#">Derma Spa</a></h6>
                        <div class="listing-offer-thumbnail">
                            <img src="<?= site_url("/resources/img/listing-offer-thumbnail3.png") ?>" alt="">
                        </div>
                        <div class="listing-offer-content">
                            <span class="location"><i class="fa fa-map-marker"></i> Manila, Philippines</span>
                            <ul class="rate">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <span class="count">208 reviews</span>
                        </div>
                    </div>
                    <div class="listing-offer">
                        <h6 class="title"><a href="#">Kelly’s Spa</a></h6>
                        <div class="listing-offer-thumbnail">
                            <img src="<?= site_url("/resources/img/listing-offer-thumbnail4.png") ?>" alt="">
                        </div>
                        <div class="listing-offer-content">
                            <span class="location"><i class="fa fa-map-marker"></i> Manila, Philippines</span>
                            <ul class="rate">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                            <span class="count">208 reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>