<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4"
        <h2><?= $title; ?></h2>
        <div class="form-group">
        <label>Nimi</label>
        <input type="text" class="form-control" name="nimi" placeholder="Nimi"
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email"
        </div>
        <div class="form-group">
            <label>Kasutajanimi</label>
            <input type="text" class="form-control" name="kasutajanimi" placeholder="Kasutajanimi"
        </div>
        <div class="form-group">
            <label>Parool</label>
            <input type="password" class="form-control" name="parool" placeholder="Parool"
        </div>
        <div class="form-group">
            <label>Parooli kordus</label>
            <input type="password" class="form-control" name="parool2" placeholder="Parooli kordus"
        </div>
        <button type="submit" class="btn btn-primary">Loo kasutaja</button>
    </div>
</div>
<?php echo form_close(); ?>
