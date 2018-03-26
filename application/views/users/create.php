<?= form_open('admin/users/save', 'role="form"'); ?><?php if (validation_errors() != NULL && validation_errors() != '') { ?>
    <div class="alert alert-danger"><?= validation_errors(); ?></div><?php } ?>
<input type="hidden" name="id" value="<?= isset($users) ? $users->id : '' ?>"/>

<div class="form-group">
    <label for="username">Usuario:</label><br/>
    <input type="text" required class="form-control" name="username" placeholder="Escriba el nombre de usuario"
           value="<?= isset($users) ? $users->username : '' ?>"/>

</div>
<div class="form-group">
    <label for="email">Correo:</label><br/>
    <input type="text" required class="form-control" name="email" placeholder="Correo"
           value="<?= isset($users) ? $users->email : '' ?>"/>

</div>
<?php if (!isset($users)): ?>
    <div class="form-group">
        <label for="password">Contraseña:</label><br/>
        <input type="password" required class="form-control" name="password" placeholder="Contraseña"
               value="<?= isset($users) ? $users->password : '' ?>"/>

    </div>
    <div class="form-group">
        <label for="password">Repita Contraseña:</label><br/>
        <input type="password" required class="form-control" name="password2" placeholder="Repita Contraseña" value=""/>

    </div>
<?php endif; ?>
<?php //if ($this->ion_auth->is_admin()): ?>

    <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
    <?php foreach ($groups as $group): ?>
        <label class="checkbox">
            <?php
            $gID = $group['id'];
            $checked = null;
            $item = null;
            if (isset($currentGroups))
            foreach ($currentGroups as $grp) {
                if ($gID == $grp->id) {
                    $checked = ' checked="checked"';
                    break;
                }
            }
            ?>
            <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
            <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
        </label>
    <?php endforeach ?>

<?php //endif ?>
<!--div class="form-group">
    <label for="role">Role:</label><br/>
    <input type="text" class="form-control" name="role" placeholder="Enter Role"
           value="<?= isset($users) ? $users->role : '' ?>"/>

</div-->
<input type="submit" value="Guardar" class="btn btn-primary"/>
<?= anchor('admin/users/index', 'Atras', 'class="btn btn-link"'); ?>
</form>

