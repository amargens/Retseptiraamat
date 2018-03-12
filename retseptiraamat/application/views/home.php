<!DOCTYPE html>

<div>
    <?php
    echo "<h2>Siia tuleb retsepti raamatu koduleht.</h2>";
    ?>
</div>

<div>
    <?php foreach ($recipes as $recipe_item): ?>

        <h3><?php echo $recipe_item['_title']; ?></h3>
        <?php if ( file_exists(APPPATH.'assets/recipe_img/'.$recipe_item['_imgpath'])) {
                $source = '../../application/assets/recipe_img/'.$recipe_item['_imgpath'];
                echo "<img src='".$source."' width='200px' alt='Contect Image'>";
            }
            else {
                echo "<img src='' width='200px' alt='Contect Image'>";
            }
            
        
        ?>
        <div class="main">
                <?php echo $recipe_item['_text']; ?>
        </div>

    <?php endforeach; ?>
</div>

