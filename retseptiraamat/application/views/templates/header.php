<!DOCTYPE html>

<html>
<head>
    
    <meta charset="utf-8">
    <title>Retsepti Raamat</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/<?php echo $title; ?>.css">
    <script type = 'text/javascript' src = "<?php echo base_url();  ?>js/<?php echo $title; ?>.js"></script>
</head>
<body>

    <?php echo anchor('Pages/view/home', 'home'); ?>
    <?php echo anchor('Pages/view/create', 'create'); ?>