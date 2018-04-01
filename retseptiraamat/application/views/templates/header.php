<!DOCTYPE html>

<html lang="en">
<head>
    
    <meta charset="utf-8">
    <title>Retsepti Raamat</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css"  type="text/css" />
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/app.css">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/<?php echo $title; ?>.css">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin=""/>
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster-src.js"></script>
    
    <script type = "text/javascript" src = "<?php echo base_url();  ?>js/app.js"></script>
    <script type = "text/javascript" src = "<?php echo base_url();  ?>js/<?php echo $title; ?>.js"></script>
    
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
                <li><a href="<?php echo base_url();?>index.php/home/" data-tag="all_recipes"></a> </li>
                <li><a href="<?php echo base_url();?>index.php/map/" data-tag="map"></a> </li>
                <?php if(!$this->session->userdata('sisselogitud')) : ?>
                    <li><a href="<?php echo base_url();?>index.php/users/login" data-tag="login"></a> </li>
                    <li><a href="<?php echo base_url();?>index.php/users/register/" data-tag="register"></a> </li>
                <?php endif; ?>
                <?php if($this->session->userdata('sisselogitud')) : ?>
                    <li><a href="<?php echo base_url();?>index.php/create/" data-tag="create"></a> </li>
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
</div>