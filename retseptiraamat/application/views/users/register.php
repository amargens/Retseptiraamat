<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2 data-tag="header"></h2>
        <div class="form-group">
        <label data-tag="nameLbl"></label>
        <input type="text" class="form-control" name="nimi" data-tag="name" >
        </div>
        <div class="form-group">
            <label data-tag="emailLbl"></label>
            <input type="email" class="form-control" name="email" data-tag="email" >
        </div>
        <div class="form-group">
            <label data-tag="usernameLbl"></label>
            <input type="text" class="form-control" name="kasutajanimi" data-tag="username" >
        </div>
        <div class="form-group">
            <label data-tag="pswrdLbl"></label>
            <input type="password" class="form-control" name="parool" data-tag="pswrd" >
        </div>
        <div class="form-group">
            <label data-tag="pswrdRLbl"></label>
            <input type="password" class="form-control" name="parool2" data-tag="pswrdR" >
        </div>
        <button type="submit" class="btn btn-primary" data-tag="loginBtn"></button>
    </div>
</div>
<?php echo form_close(); ?>
