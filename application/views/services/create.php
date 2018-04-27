<?= form_open_multipart('admin/services/save', array('role' => 'form', 'class' => 'f1', 'id' => 'form-service')); ?><?php if (validation_errors() != NULL && validation_errors() != '') { ?>
    <div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
<nav aria-label="Page navigation">
    <ul class="pagination step-views">
        <div class="f1-progress">
            <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="5" style="width: 16.66%;"></div>
        </div>
        <li class="f1-step active"><a name="step1" href="#">1</a></li>
        <li class="f1-step"><a name="step2" href="#">2</a></li>
        <li class="f1-step"><a name="step3" href="#">3</a></li>
        <li class="f1-step"><a name="step4" href="#">4</a></li>
        <li class="f1-step"><a name="step5" href="#">5</a></li>

    </ul>
</nav>


<div class="step listing-3 listing-variation">
    <div class="container">
        <div id="step1" class="item-step active">
            <div class="form-group">
                <input type="hidden" name="id" value="<?= isset($services) ? $services->id : '' ?>"/>
            </div>
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
                <label for="phone">Descripción:</label><br/>
                <textarea rows="3" cols="50" class="form-control" name="description"
                          placeholder="Descripción del servicio"
                          value="<?= isset($services) ? $services->getDescription() : '' ?>"></textarea>
            </div>
            <div class="form-group">
                <label for="cities">Cuidades*:</label><br/>
                <select multiple="true" class="custom-select" name="cities[]"
                        placeholder="Escoja la ciudad">
                    <?php
                    foreach ($cities as $city) {
                        $selected = '';
                        if (isset($currenCities)) {
                            foreach ($currenCities as $cCity) {
                                if ($city->id == $cCity->id) {
                                    $selected = "selected ='selected'";
                                    break;
                                }
                            }
                        }
                        echo "<option value='$city->id' $selected>$city->title </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="categories">Categorías*:</label><br/>
                <select multiple="true" class="custom-select" name="categories[]"
                        placeholder="Escoja la categoría">
                    <?php foreach ($subcategories as $subcategory): $selected = ''; ?>
                        <?php if (isset($currenSubCategories)) {
                            foreach ($currenSubCategories as $cSubcat) {
                                if ($subcategory->id == $cSubcat->id) {
                                    $selected = "selected ='selected'";
                                    break;
                                }
                            }
                        }
                        echo "<option value='$subcategory->id' $selected>$subcategory->title </option>";
                        ?>
                    <?php endforeach; ?>
                </select>
            </div>


            <div class="f1-buttons">
                <button type="button" class="btn btn-next bg-tema">Proximo</button>
            </div>
        </div>
        <div id="step2" class="item-step ">
            <?php if (isset($services)): ?>
                <div class="row">
                    <?php foreach ($currenImages as $key => $image): ?>
                        <div class="card m-3 disabled" style="width: 18rem;">
                            <img class="card-img-top" src="<?= site_url(). $image->title ?>" alt="Card image cap">
                            <div class="card-body align-bottom"
                                 style="height: 25px; position: absolute; right: 5px; bottom: 5px;">
                                <a id="<?= $image->id ?>" href="#" title="Eliminar" class="card-link delete-image align-right remove-icon">
                                    <i class="fa fa-trash" style="color: white"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <input type="hidden" name="images_deleted" id="images_deleted" value="[]"/>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="icon">Im&aacute;genes:</label><br/>
                <input type="file" id="userfile" name="userfile[]" size="20" multiple/>
            </div>
            <div id="image_preview" class="row">

            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous bg-tema">Anterior</button>
                <button type="button" class="btn btn-next bg-tema">Proximo</button>
            </div>
        </div>
        <div id="step3" class="item-step ">
            <div class="form-group">
                <label for="other_phone">Teléfono adicional:</label><br/>
                <input type="text" class="form-control" name="other_phone" placeholder="Escriba un Teléfono adicional"
                       value="<?= isset($services) ? $services->other_phone : '' ?>"/></div>
            <div class="form-group">
                <label for="email">Correo electrónico:</label><br/>
                <input type="email" class="form-control" name="email"
                       placeholder="Escriba su Correo electrónico"
                       value="<?= isset($services) ? $services->email : '' ?>"/>
            </div>
            <div class="form-group">
                <label for="url">Dirección web:</label><br/>
                <input type="url" class="form-control" name="url" placeholder="Escriba su dirección web"
                       value="<?= isset($services) ? $services->url : '' ?>"/>
            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous bg-tema">Anterior</button>
                <button type="button" class="btn btn-next bg-tema" onclick="initMap()">Proximo</button>
            </div>
        </div>
        <div id="step4" class="item-step ">
            <h2>Gestión de Ubicación</h2>
            <div class="posiciones">
                <!--<mat-form-field>-->
                <!--<input matInput placeholder="Nombre ubicación" name="positiontitle"-->
                <!--[(ngModel)]="positiontitle"-->
                <!--[formControl]="positionsForm.controls['positiontitle']"-->
                <!--minlength="1">-->
                <!--<mat-error *ngIf="positionsForm.controls['positiontitle'].invalid">-->
                <!--{{getErrorMessage()}}-->
                <!--</mat-error>-->
                <!--</mat-form-field>-->
                <label for="positiontitle">Nombre ubicación</label>
                <input type="text" id="positiontitle" name="positiontitle" type="text">
                <div id="map_create"></div>
                <br>
                <input type="button"
                       class="col-12" value="Agregar posiciones" id="addPosition"/>
                <input type="hidden" value="[]" name="positions" id="positions"/>

                <script>
                    var jsonobj = <?php echo json_encode($currenPositions)?>;
                  if(Array.isArray(jsonobj)){
                      document.getElementById("positions").value = JSON.stringify(jsonobj);
                  }

              </script>
              <div id="visual_positions">

              </div>
          </div>
          <div class="f1-buttons">
              <button type="button" class="btn btn-previous bg-tema">Anterior</button>
              <button type="button" class="btn btn-next bg-tema">Proximo</button>
          </div>
      </div>
      <div id="step5" class="item-step ">
          <h2>Gestión de horarios</h2>
          <label>Días de atención</label>
          <br/>
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
                    <input type="checkbox" name="week_days[]" value="<?php echo $key; ?>" data-day="<?= $day ?>"/>
                    <?php echo htmlspecialchars($day, ENT_QUOTES, 'UTF-8'); ?>
                </label>
            <?php endforeach; ?>
            <br/>
            <!--div class="form-group">
                <label for="week_days">Week_days:</label><br/>
                <input type="text" class="form-control" name="week_days" placeholder="Enter Week_days"
                       value="<?= isset($services) ? $services->week_days : '' ?>"/>
            </div-->
            <label>Horario de atención</label>
            <div class="form-group">
                <label for="start_time">Desde::</label><br/>
                <input type="time" class="form-control" name="start_time" placeholder="Enter Start_time"
                       value="<?= '08:00' ?>"/>
            </div>
            <div class="form-group">
                <label for="end_time">Hasta:</label><br/>
                <input type="time" class="form-control" name="end_time" placeholder="Enter End_time"
                       value="<?= '16:00' ?>"/>
            </div>
            <input type="hidden" value="[]" name="times" id="times"/>
            <script>
                var jsonobjtime = <?php echo json_encode($currenTimes)?>;
                console.log("times registrados",jsonobjtime);
                if(Array.isArray(jsonobjtime)){
                    document.getElementById("times").value = JSON.stringify(jsonobjtime);
                }
            </script>
            <input type="button" class="btn btn-info" id="add_time" value="Agregar Horario"
                   style="margin-bottom: 20px"/>
            <div id="visual_horarios">

            </div>
            <div class="f1-buttons">
                <button type="button" class="btn btn-previous">Anterior</button>
                <button type="submit" class="btn btn-submit  btn-primary" id="submitform">Crear</button>
            </div>
        </div>
    </div>
</div>
</form>

