

<div class="col-md-6 col-md-offset-2">
    <form class="form-inline" role="form" action="<?php echo base_url().'index.php/home/keysearch'; ?>" method="post">
        <div class="input-group">
            <input type="text" name="search" class="form-control" id="search" data-tag="search">
            <span class="input-group-btn">
            <button class="btn btn-default glyphicon-search" type="submit"></button>
        </span>
        </div>
    </form>
</div>
<div class="table-responsive col-md-8 col-md-offset-2">
    <table class="table">
        <thead>
            <tr>
                <th scope="col" data-tag="title"></th>
                <th scope="col" data-tag="image"></th>
                <th scope="col" data-tag="text"></th>
                <th scope="col" data-tag="more"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recipes as $recipe_item): ?>
            <tr>
                <td><?php echo $recipe_item['_title']; ?></td>
                <td>
                    <?php if ( file_exists(APPPATH.'assets/recipe_img/'.$recipe_item['_imgpath'])) {
                            $source = '../../application/assets/recipe_img/'.$recipe_item['_imgpath'];
                            echo "<img src='".$source."' class='showImage' alt='Contect Image'>";
                        }
                        else {
                            echo "<img src='../../application/assets/example_img.jpg' class='showImage' alt='Contect Image'>";
                        }


                    ?>
                </td>
                <td>
                    <div class="text">
                            <?php echo mb_substr($recipe_item['_text'], 0, 25) . "..."; ?>
                    </div>
                </td>
                <td>
                    <p><a href="<?php echo base_url();?>index.php/Recipe/view/<?php echo $recipe_item['_recipeID'];?>" data-tag="readmore"></a></p>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

