<div class="listing listing-3 listing-variation">

<div class="container">
<div class="row">
    <?php foreach ($services as $object) { ?>
<div class="col-md-4 listing-grid listing-grid-2">
    <div class="listing-heading">
        <?php if($object->professional==1){?>
        <div class="marker-ribbon">
            <div class="ribbon-banner">
                <div class="ribbon-text">Profesional</div>
            </div>
        </div>
        <?php } ?>
        <h5><?= $object->title ?></h5>
    </div>
    <div class="listing-inner">
        <div class="flexslider default-slider">
            <ul class="slides">
                <li class="flex-active-slide" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity:1; display: block; z-index: 2;"><img src="<?=$object->icon?>" alt="" draggable="false"></li>
                <?php
                $images = $object->getImages()->toArray();
                foreach ( $images as $image  ){
                    echo   '<li class="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;"><img src="'.$image->getTitle().'" alt="" draggable="false"></li>';
                }
                ?>
            </ul>
            <div class="reviews">
                <ul class="">
                    <?php $rate = $object->getGlobalrate();

                    for ($pos = 0;$pos<10;$pos++){
                        if($pos<$rate){
                            echo'<li><i class="fa fa-star "></i></li>';
                        }else{
                            echo ' <li><i class="fa fa-star-o"></i></li>';
                        }
                    }
                    ?>
                </ul>
                <span class="count"><?=$object->getReviews()?> reviews</span>
            </div>
            <ol class="flex-control-nav flex-control-paging"><li><a class="">1</a></li><li><a class="flex-active">2</a></li><li><a class="">3</a></li><li><a class="">4</a></li></ol><ul class="flex-direction-nav"><li><a class="flex-prev" href="#"></a></li><li><a class="flex-next" href="#"></a></li></ul></div>
        <ul class="uou-accordions">
            <li class="active">
                <a href="#"><i class="fa fa-info main-icon"></i> Información</a>
                <div>
                    <h5 class="title"><?= $object->subtitle?></h5>
                    <p><?=$object->description ?></p>
                </div>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-envelope main-icon"></i> Información adicional</a>
                <div>
                    <ul class="contact-info list-unstyled mb0">

                        <?php if($object->address){?>  <li><i class="fa fa-map-marker"></i> <?= $object->address ?></li><?php } ?>
                        <?php if($object->email){?>  <li><i class="fa fa-envelope-o"></i> <?= $object->email ?></li><?php } ?>
                        <?php if($object->url){?>  <li><i class="fa fa-globe"></i><?= $object->url ?></li><?php } ?>
                        <?php if($object->phone){?>  <li><i class="fa fa-phone"></i><?= $object->phone ?></li><?php } ?>
                       <?php if($object->other_phone){?> <li><i class="fa fa-fax"></i> <?= $object->other_phone ?></li> <?php } ?>
                    </ul>
                </div>
            </li>
        </ul> <!-- end .uou-accordions -->
    </div>
    <div class="info-footer">
        <img height="20" width="20" src="<?=$object->getSubcategories()->toArray()[0]->getIcon()?>">
        <h6><?=$object->getSubcategories()->toArray()[0]->getTitle()?></h6>
        <i class="fa fa-bookmark bookmark pull-right"></i>
    </div>
</div>
    <?php } ?>
</div>
</div>
</div>

