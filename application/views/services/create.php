<nav aria-label="Page navigation">
    <ul class="pagination step-views">
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="step active"><a name="step1" href="#">1</a></li>
        <li class="step"><a name="step2" href="#">2</a></li>
        <li class="step"><a name="step3" href="#">3</a></li>
        <li class="step"><a name="step4" href="#">4</a></li>
        <li class="step"><a name="step5" href="#">5</a></li>
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
<?= form_open_multipart('admin/services/save', 'role="form"'); ?><?php if (validation_errors() != NULL && validation_errors() != '') { ?>
    <div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
<div class="step listing-3 listing-variation">
    <div class="container">
        <div id="step1" class="item-step">
            <input type="hidden" name="id" value="<?= isset($services) ? $services->id : '' ?>"/>
            <div class="form-group">
                <label for="title">Título*:</label><br/>
                <input type="text" required class="form-control" name="title" placeholder="Escribe el Título"
                       value="<?= isset($services) ? $services->title : '' ?>"/>
            </div>
            <div class="form-group">
                <label for="subtitle">Slogan*:</label><br/>
                <input type="text" required class="form-control" name="subtitle" placeholder="Escribe el Subtítulo"
                       value="<?= isset($services) ? $services->subtitle : '' ?>"/>
            </div>
            <div class="form-group">
                <label for="address">Dirección*:</label><br/>
                <input type="text" required class="form-control" name="address" placeholder="Escribe la Dirección"
                       value="<?= isset($services) ? $services->address : '' ?>"/>
            </div>
            <div class="form-group">
                <label for="phone">Teléfono*:</label><br/>
                <input type="text" class="form-control" name="phone" placeholder="Escribe el Teléfono"
                       value="<?= isset($services) ? $services->phone : '' ?>"/>
            </div>
            <div class="form-group">
                <label for="phone">Descripción*:</label><br/>
                <textarea rows="3" cols="50" class="form-control" name="description"
                          placeholder="Descripción del servicio"
                          value="<?= isset($services) ? $services->description : '' ?>">
                </textarea>
            </div>
            <div class="form-group">
                <label for="cities">Cuidades*:</label><br/>
                <select multiple="true" class="custom-select" name="cities[]"
                        placeholder="Escoja la ciudad">
                    <?php
                    foreach ($cities as $city) {
                        echo "<option value='$city->id'>$city->title </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="categories">Categorías*:</label><br/>
                <select multiple="true" class="custom-select" name="categories[]"
                        placeholder="Escoja la categoría">
                    <?php
                    foreach ($subcategories as $subcategory) {
//                $is_selected = ($subcategory->category_id==$category->id)?"selected":"";
//            echo "<option value='$subcategory->id' $is_selected>$subcategory->title </option>";
                        echo "<option value='$subcategory->id'>$subcategory->title </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="icon">Foto*:</label><br/>
                <?php if (isset($services)) { ?>
                    <img src="<?= $services->icon ?>" width="80px" height="70px"/>
                <?php } ?>
                <input type="file" required name="userfile" size="20"
                       value="<?= isset($services) ? $services->icon : '' ?>"/>
            </div>
        </div>
        <div id="step2" class="item-step hide">
            <?php if (isset($services)): ?>
                <?php foreach ($images as $key => $image): ?>
                    <div class="form-group">
                        <label for="icon">Imagen:</label><br/>
                        <img src="<?= $image->thumb ?>" width="80px" height="70px"/>
                        <input type="file"  name="thumbs[]" size="20" value="<?= $image->thumb ?>"/>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
<!--                --><?php //for ($i = 0; $i < 9; $i++): ?>
<!--                    <div class="form-group">-->
<!--                        <label for="icon">Imagen2:</label><br/>-->
<!--                        <input type="file"  name="thumbs[]" size="20" value=""/>-->
<!--                    </div>-->
<!--                --><?php //endfor; ?>
                                    <div class="form-group">
                                        <label for="icon">Imagen2:</label><br/>
                                        <input type="file"  name="thumbs1" size="20" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <label for="icon">Imagen2:</label><br/>
                                        <input type="file"  name="thumbs2" size="20" value=""/>
                                    </div>
            <?php endif; ?>
        </div>
        <div id="step3" class="item-step hide">
            <div class="form-group">
                <label for="other_phone">Teléfono adicional:</label><br/>
                <input type="text" class="form-control" name="other_phone" placeholder="Escriba un Teléfono adicional"
                       value="<?= isset($services) ? $services->other_phone : '' ?>"/>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico:</label><br/>
                <input type="email" required class="form-control" name="email"
                       placeholder="Escriba su Correo electrónico"
                       value="<?= isset($services) ? $services->email : '' ?>"/>
            </div>
            <div class="form-group">
                <label for="url">Dirección web:</label><br/>
                <input type="url" class="form-control" name="url" placeholder="Escriba su dirección web"
                       value="<?= isset($services) ? $services->url : '' ?>"/>
            </div>
        </div>
        <div id="step4" class="item-step hide">
            <h2>Gestión de Ubicación</h2>
            <div class="form-group">
                <label for="positions_id">Posiciones*:</label><br/>
                <select multiple="true" class="custom-select" name="positions[]"
                        placeholder="Escoja la pocisión">
                    <?php
                    foreach ($positions as $position) {
                        echo "<option value='$position->id'>$position->title </option>";
                    }
                    ?>
                </select>
            </div>

        </div>
        <div id="step5" class="item-step hide">
            <h2>Gestión de horarios</h2>
            <label>Días de atención</label>
            <?php foreach ($days_of_weak as $key => $day): ?>
                <label class="checkbox">
                    <?php
                    //                    if (isset($currentGroups))
                    //                        foreach ($currentGroups as $grp) {
                    //                            if ($gID == $grp->id) {
                    //                                $checked = ' checked="checked"';
                    //                                break;
                    //                            }
                    //                        }
                    ?>
                    <input type="checkbox" name="week_days[]" value="<?php echo $key; ?>">
                    <?php echo htmlspecialchars($day, ENT_QUOTES, 'UTF-8'); ?>
                </label>
            <?php endforeach; ?>
            <!--div class="form-group">
                <label for="week_days">Week_days:</label><br/>
                <input type="text" class="form-control" name="week_days" placeholder="Enter Week_days"
                       value="<?= isset($services) ? $services->week_days : '' ?>"/>
            </div-->
            <label>Horario de atención</label>
            <div class="form-group">
                <label for="start_time">Desde::</label><br/>
                <input type="time" class="form-control" name="start_time" placeholder="Enter Start_time"
                       value="<?= isset($services) ? $services->start_time : '' ?>"/>
            </div>
            <div class="form-group">
                <label for="end_time">Hasta:</label><br/>
                <input type="time" class="form-control" name="end_time" placeholder="Enter End_time"
                       value="<?= isset($services) ? $services->end_time : '' ?>"/>
            </div>
        </div>
    </div>
</div>
<input type="submit" value="Save" class="btn btn-primary"/>
<?= anchor('admin/services/index', 'Back', 'class="btn btn-link"'); ?>
</form>

