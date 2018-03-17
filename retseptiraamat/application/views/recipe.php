<!DOCTYPE html>

<div class="col-md-offset-4">
    <?php
    echo "<h2>Siia tuleb retsepti vaateleht.</h2>";
    ?>
</div>

<div class="col-md-offset-4">

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

