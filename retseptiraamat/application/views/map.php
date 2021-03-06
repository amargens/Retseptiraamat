
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 data-tag="header"></h2>
        <label data-tag="mapi"></label>
        <a class="trigger_popup_fricc"><img src="<?php echo base_url(); ?>application/assets/proov2.png" alt="hint"></a>

        <div class="hover_bkgr_fricc">
            <span class="helper"></span>
            <div>
                <div class="popupCloseButton">x</div>
                <p data-tag="popup"></p>
            </div>
        </div>
        <div id="map"></div>
        <form method="post" id="formmap" class="inputhidden" name="formmap" accept-charset="utf-8">
            <input type="text" id="inputmap" value="" name="inputmap" />
            <input type="submit" value="Submit">
        </form>
    </div>
</div>

<div class="row">
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
</div>





