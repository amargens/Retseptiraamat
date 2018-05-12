<?php //echo form_open('users/login'); ?>



<div class="row">
    <div class = "col-md-4 col-md-offset-4">
        <form method="post" id="formlogin" name="formlogin" accept-charset="utf-8" action="<?php echo base_url().'index.php/users/login'; ?>">
            <h2 data-tag="header"></h2>
            <div class="form-group">
                <label data-tag="usernameLabel"></label>
                <input type="text" id="kasutajanimi" name="kasutajanimi" class="form-control" data-tag="username" required autofocus>
            </div>
            <div id="parooldiv" class="form-group">
                <label data-tag="passwordLabel"></label>
                <input type="password" id="parool" name="parool" class="form-control" data-tag="psword" required autofocus>
            </div>
        <div class="form-group">
            <input type="radio" name="logintype" id="passwrdLabel" value="password" checked>
            <label for="passwrdLabel" data-tag="passwrdLabel"></label>
            <input type="radio" name="logintype" id="googleLabel" value="google">
            <label for="googleLabel" data-tag="googleLabel"></label>
        </div>
        <button type="submit" class="btn btn-primary" id="submitlogin" data-tag="loginBtn"></button>
            
        <?php echo form_close(); ?>
    </div>
</div>


