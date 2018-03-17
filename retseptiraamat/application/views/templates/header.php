<!DOCTYPE html>

<html lang="en">
<head>
    
    <meta charset="utf-8">
    <title>Retsepti Raamat</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css"  type="text/css" />
<!--    <link rel = "stylesheet" type = "text/css" href = "--><?php //echo base_url(); ?><!--css/--><?php //echo $title; ?><!--.css">-->
    <script type = "text/javascript" src = "<?php echo base_url();  ?>js/<?php echo $title; ?>.js"></script>
</head>
<body>

<!--    <?php /*echo anchor('Pages/view/home', 'home'); */?>
    --><?php /*echo anchor('Pages/view/create', 'create'); */?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div id="logobox">
            <a href="<?php echo base_url();?>index.php/home/""><img src="<?php echo base_url(); ?>application/assets/logo.png" alt="logo"></a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url();?>index.php/home/"> Avaleht </a> </li>
                <li><a href="<?php echo base_url();?>index.php/home/"> Kõik retseptid </a> </li>
                <li><a href="<?php echo base_url();?>index.php/create/"> Retsepti lisamine </a> </li>
            </ul>
        </div>
    </div>
</nav>
