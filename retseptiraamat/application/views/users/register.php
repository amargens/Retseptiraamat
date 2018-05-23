<?php echo validation_errors(); ?>

<?php echo form_open('users/register'); ?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h2 data-tag="header"></h2>
        <div class="form-group">
        <label data-tag="nameLbl"></label>
        <input type="text" class="form-control" name="nimi" data-tag="name" required autofocus>
        </div>
        <div class="form-group">
            <label data-tag="emailLbl"></label>
            <input type="email" class="form-control" name="email" data-tag="email" required autofocus>
        </div>
        <div class="form-group">
            <label data-tag="usernameLbl"></label>
            <a class="trigger_popup_fricc"><img src="<?php echo base_url(); ?>application/assets/proov2.png" alt="hint"></a>

            <div class="hover_bkgr_fricc">
                <span class="helper"></span>
                <div>
                    <div class="popupCloseButton">x</div>
                    <p data-tag="popup"></p>
                </div>
            </div>
            <br />
            <input type="text" class="form-control" name="kasutajanimi" data-tag="username" required autofocus>
        </div>
        <div class="form-group">
            <label data-tag="pswrdLbl"></label>
            <input type="password" class="form-control" name="parool" data-tag="pswrd" required autofocus>
        </div>
        <div class="form-group">
            <label data-tag="pswrdRLbl"></label>
            <input type="password" class="form-control" name="parool2" data-tag="pswrdR" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary" data-tag="loginBtn"></button>
    </div>
</div>
<?php echo form_close(); ?>
