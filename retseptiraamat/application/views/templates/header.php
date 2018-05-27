<!DOCTYPE html>

<html lang="en">
<head>
    
    <meta charset="utf-8">
    <title>Retsepti Raamat</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css"  type="text/css" />
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/app.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/<?php echo $title; ?>.css">
    
</head>
<body>

<!--    <?php /*echo anchor('Pages/view/home', 'home'); */?>
    --><?php /*echo anchor('Pages/view/create', 'create'); */?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div id="logobox">
            <a href="<?php echo base_url();?>index.php/home/"><img src="<?php echo base_url(); ?>application/assets/logo.png" alt="logo"></a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url();?>index.php/home/" data-tag="home"></a> </li>
                <li><a href="<?php echo base_url();?>index.php/advsearch" data-tag="advsearch"></a> </li>
                <li><a href="<?php echo base_url();?>index.php/map/" data-tag="map"></a> </li>
                <li><a href="<?php echo base_url();?>index.php/stats/" data-tag="stats"></a> </li>
                <?php if(!$this->session->userdata('sisselogitud')) : ?>
                    <li><a href="<?php echo base_url();?>index.php/users/login" data-tag="login"></a> </li>
                    <li><a href="<?php echo base_url();?>index.php/users/register" data-tag="register"></a> </li>
                <?php endif; ?>
                <?php if($this->session->userdata('sisselogitud')) : ?>
                    <li><a href="<?php echo base_url();?>index.php/create/" data-tag="create"></a> </li>
                    <li><a href="<?php echo base_url();?>index.php/account/" data-tag="account"></a> </li>
                    <li><a href="<?php echo base_url();?>index.php/users/logivalja" data-tag="logout"></a> </li>
                <?php endif; ?>
                <li>
                    <form method="post" id="formlang" name="formlang" accept-charset="utf-8">
                        <select class="form-control selcls" id="sel-lang">
                            <option value="ee">EST</option>
                            <option value="en">ENG</option>
                        </select>
                        <input type="submit" class="inputhidden" value="Submit">
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <?php if($this->session->flashdata('kasutaja_registreeritud')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('kasutaja_registreeritud').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('kasutaja_fail')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('kasutaja_fail').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('kasutaja_sisselogitud')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('kasutaja_sisselogitud').'</p>'; ?>
    <?php endif; ?>

    <?php if($this->session->flashdata('kasutaja_valjalogitud')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('kasutaja_valjalogitud').'</p>'; ?>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('eba_otsing')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('eba_otsing').'</p>'; ?>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('lisa_error')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('lisa_error').'</p>'; ?>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('kasutaja_google')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('kasutaja_google').'</p>'; ?>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('changeerror')): ?>
        <?php echo '<p class="alert alert-danger">'.$this->session->flashdata('changeerror').'</p>'; ?>
    <?php endif; ?>
    
    <?php if($this->session->flashdata('changesuccess')): ?>
        <?php echo '<p class="alert alert-success">'.$this->session->flashdata('changesuccess').'</p>'; ?>
    <?php endif; ?>
</div>