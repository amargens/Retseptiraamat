<?php echo form_open('users/login'); ?>

    <div class="row">
        <div class = "col-md-4 col-md-offset-4">
        <h2 data-tag="header"></h2>
        <div class="form-group">
            <label data-tag="usernameLabel"></label>
            <input type="text" name="kasutajanimi" class="form-control" data-tag="username" required autofocus>
        </div>
        <div class="form-group">
            <label data-tag="passwordLabel"></label>
            <input type="password" name="parool" class="form-control" data-tag="psword" required autofocus>
        </div>
        <button type="submit" class="btn btn-primary" data-tag="loginBtn"></button>
    </div>
<?php echo form_close(); ?>