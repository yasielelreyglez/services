<?php
/**
 * Created by PhpStorm.
 * User: Kenny
 * Date: 5/30/2018
 * Time: 10:37 PM
 */
?>
<?= form_open_multipart('admin/pagesc/addImages', array('role' => 'form', 'class' => 'f1', 'id' => 'form-service')); ?><?php if (validation_errors() != NULL && validation_errors() != '') { ?>
    <div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
<div class="form-group">
    <label for="icon">Subir imágenes:</label><br/>
    <input type="file" required id="userfile" name="userfile[]" size="20" multiple class="pull-left"/>
    <input type="submit" value="Subir" class="btn btn-primary pull-right" style="margin-top: -5px"/>
</div>
</form>

<?php if (isset($dirContent)): ?>
    <div class="row">
        <?php foreach ($dirContent as $element): ?>
            <?php if (is_file('./resources/img/' . $element)): ?>
                <div class="card m-3 disabled" style="width: 18rem;">
                    <img class="payment-evidence card-img-top" src="<?= site_url() . 'resources/img/' . $element ?>"
                         alt="Card image cap">
<!--                    <div class="card-body align-bottom"-->
<!--                         style="height: 25px; position: absolute; right: 5px; bottom: 5px;">-->
<!--                        <a id="--><?//= $element ?><!--" href="#" title="Eliminar"-->
<!--                           class="card-link delete-image align-right remove-icon">-->
<!--                            <i class="fa fa-trash" style="color: white"></i>-->
<!--                        </a>-->
<!--                    </div>-->
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>



<!-- The Modal -->
<div id="imageZoomModal" class="modal">

    <!-- Modal Caption (Image Text) -->
    <div id="caption" style="text-align: center"></div>

    <!-- The Close Button -->
    <span class="close">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01">
</div>