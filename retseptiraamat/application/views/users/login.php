<?php echo form_open('users/login'); ?>

    <div class="row">
        <div class = "col-md-4 col-md-offset-4"
        <h2><?php echo $title; ?></h2>
        <div class="form-group">
            <input type="text" name="kasutajanimi" class="form-control" placeholder="Sisesta kasutajanimi" required autofocus>
        </div>
        <div class="form-group">
            <input type="password" name="parool" class="form-control" placeholder="Sisesta parool" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary">Logi sisse</button>
    </div>
<?php echo form_close(); ?>