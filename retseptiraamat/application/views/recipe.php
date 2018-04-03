<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <ol class="breadcrumb">
            <li><a href="#">Avaleht</a></li>
            <li><a href="#">Otsing</a></li>
            <li class="active">Retsept</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 data-tag="header"></h2>
        <h3 col-md-6><?php echo $recipe[0]['_title']; ?></h3>
        <?php if ( file_exists(APPPATH.'assets/recipe_img/'.$recipe[0]['_imgpath'])) {
                $source = '../../../application/assets/recipe_img/'.$recipe[0]['_imgpath'];
                echo "<img src='".$source."' id='showImage' alt='Contect Image'>";
            }
            else {
                echo "<img src='../../../application/assets/example_img.jpg' id='showImage' alt='Contect Image'>";
            }
        ?>

        <?php foreach ($recipe as $recipe_item): ?>

            <div class="text">
            <?php echo $recipe_item['_ingredient']; ?>
            <?php echo $recipe_item['_amount']; ?>
            <?php echo $recipe_item['_unit']; ?>
            </div>

        <?php endforeach; ?>

        <div class="text col-md-6">
            <?php echo $recipe[0]['_text']; ?>
        </div>
    </div>
</div>
<br />
<br />
<br />
<br />
<br />

