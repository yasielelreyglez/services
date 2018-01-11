<div class="main-content content-business single-business has-bg-image" data-bg-color="f5f5f5">
<?php $object = new \Entities\Service() ?>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="listing listing-1 single-listing">
                    <div class="listing-ver-1">
                        <div class="listing-heading">
                            <h5>Creando anunucio</h5>
                            <?php if ($object->professional == 1) {
//                                $object = new \Entities\Service();
                                ?>
                                <a href="#" class="c-red"><i class="fa fa-bookmark"></i></a>
                            <?php } ?>
                        </div>
                        <div class="listing-tabs">
                            <ul>
                                <li class="active basic"><a href="#basic" data-toggle="tab"><i class="fa fa-info"></i> &nbsp;Datos iniciales</a>
                                </li>
                                <li class="fotos"><a href="#fotos" data-toggle="tab"><i class="fa fa-map-marker"></i></a></li>
                                <li class="adicional"> <a href="#adicional" data-toggle="tab"><i class="fa fa-comments"></i></a></li>
                                <li class="ubicacion"><a href="#ubicacion" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
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
                                                <img src="<?=(isset($object->icon)?$object->icon:"resources/image/service_img.png") ?>" alt="">
                                            </div>
                                            <div class="listing-content-description margin-description">
                                                <input type="text" name="title" value="<?=$object->title?>" placeholder="Titulo del anuncio"/>
                                                           <input type="text" name="subtitle" value="<?=$object->subtitle?>" placeholder="Slogan"/>
                                                <input type="text" name="address" value="<?=$object->address?>" placeholder="Dirección"/>
                                                <input type="text" name="phone" value="<?=$object->phone?>" placeholder="Telefono"/>
                                                <label>Ubicación</label>
                                                <select class="custom-select" multiple name="city" placeholder="Ciudad">
                                                    <?php foreach ($ciudades as $ciudad){ ?>
                                                        <option value="<?=$ciudad->getId()?>"><?=$ciudad->getTitle()?></option>
                                                    <?php } ?>

                                                </select>
                                                <br/>

                                                <label>Categorias</label>
                                                <select class="custom-select" name="category" placeholder="Ciudad">
                                                    <?php foreach ($categorias as $categoria){  ?>
                                                        <option value="<?=$categoria->getId()?>"><?=$categoria->getTitle()?></option>
                                                    <?php } ?>

                                                </select>
                                                <select class="custom-select" name="category" multiple placeholder="Ciudad">
                                                    <?php foreach ($subcategorias as $categoria){  ?>
                                                        <option value="<?=$categoria->getId()?>"><?=$categoria->getTitle()?></option>
                                                    <?php } ?>

                                                </select>
                                                <br/>

                                                <textarea name="description" placeholder="Discrepcion "><?= $object->description ?></textarea>

                                                <a href="#fotos" data-toggle="tab" id="siguiente1" data-next="fotos"> <div class="btn btn-primary" >SIGUIENTE</div></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="fotos" class="tab-pane fade in contact">
                                <div class="listing-inner">
                                 <input type="file" name="upload Foto">
                                    <a href="#adicional" data-toggle="tab" id="siguiente1" data-next="adicional"> <div class="btn btn-primary" >SIGUIENTE</div></a>

                                </div>
                            </div>
                            <div id="adicional" class="tab-pane fade in contact">
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
                                                        <input type="text" value="<?= $object->email ?>"></span>
                                                    </li>
                                                    <li>
                                                        <h6>Sitio web:</h6>
                                                        <input type="text" value="<?= $object->url ?>"></span>
                                                    </li>
                                                    <li>
                                                        <h6>Telefono adicional:</h6>
                                                        <input type="text" value="<?= $object->other_phone ?>"></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="btn btn-default" id="gestionar_horarios">Gestionar Horarios</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="ubicacion" class="tab-pane fade in report">
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
                        </div>
                    </div>
                </div>
                <div class="advertiser-info">
                    <div class="advertiser-header">
                        <h5>Acerca del creador</h5>
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
