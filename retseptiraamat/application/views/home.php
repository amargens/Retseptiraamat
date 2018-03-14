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
                echo "<img src='".$source."' class='showImage' alt='Contect Image'>";
            }
            else {
                echo "<img src='../../application/assets/example_img.jpg' class='showImage' alt='Contect Image'>";
            }
            
        
        ?>
        <div class="text">
                <?php echo mb_substr($recipe_item['_text'], 0, 25) . "..."; ?>
        </div>
        
        <p><?php echo anchor('Recipe/view/'.$recipe_item['_recipeID'], 'Loe Rohkem'); ?></p>
        

    <?php endforeach; ?>
</div>

