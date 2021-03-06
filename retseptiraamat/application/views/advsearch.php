<div class="container inputhidden" id="offlinealert">
    <p class="alert alert-danger" data-tag="offline"></p>
</div>
<div class="container inputhidden" id="offlinealertsearch">
    <p class="alert alert-danger" data-tag="offlinesearch"></p>
</div>
<div class="container inputhidden" id="offlinealertsearching">
    <p class="alert alert-danger" data-tag="offlinesearching"></p>
</div>
<div class="container inputhidden" id="offlinealertsearchnoing">
    <p class="alert alert-danger" data-tag="offlinesearchnoing"></p>
</div>

<div class="col-md-6 col-md-offset-2">
    <h2 data-tag="header"></h2>
    <form class="form-inline" name="searchform" role="form" action="<?php echo base_url().'index.php/advsearch/keysearch'; ?>" method="post">
        <div class="input-group">
            <label for="search" data-tag="searchlabel"></label>
            <input type="text" name="search" class="form-control" id="search" data-tag="search">
			<br /><br /><br /><br />
            <span class="input-group-btn">
			<button class="btn btn-default glyphicon-search" id="searchbtn" type="button"></button>
        </span>
        </div>
    </form>
</div>


<div class="col-md-6 col-md-offset-2">
	<h2 data-tag="header_ee"></h2>
    <form class="form-inline" name="searchingform"  role="form" action="<?php echo base_url().'index.php/advsearch/ingredientsearch'; ?>" method="post">
        <label  data-tag="addIng_ee"></label><br />
        <a class="trigger_popup_fricc"><img src="<?php echo base_url(); ?>application/assets/proov2.png" alt="hint"></a>

        <div class="hover_bkgr_fricc">
            <span class="helper"></span>
            <div>
                <div class="popupCloseButton">x</div>
                <p data-tag="popup"></p>
            </div>
        </div>
		<input type="text" title="addIngredient" id="addIngredient_ee" name="addIngredient_ee" data-tag="sisesta_aine" />
		<button type="button" id="addIng_ee"  data-tag="addbtn_ee"></button><br />
		<br />
		<label  data-tag="addedIng_ee"></label>
		<ul id="addedIngList_ee" ></ul>
		<br />
		
		<label  data-tag="excludeIng_ee"></label><br />
        <a class="trigger_popup_fricc"><img src="<?php echo base_url(); ?>application/assets/proov2.png" alt="hint"></a>
        <div class="hover_bkgr_fricc">
            <span class="helper"></span>
            <div>
                <div class="popupCloseButton">x</div>
                <p data-tag="popup2"></p>
            </div>
        </div>
		<input type="text" title="excludeIngredient" id="excludeIngredient_ee" name="excludeIngredient_ee" data-tag="sisesta_aine" />
		<button type="button" id="excludeIng_ee"  data-tag="addbtn_ee"></button><br />
		<br />
		<label  data-tag="excludedIng_ee"></label>
		<ul id="excludedIngList_ee" ></ul>
		
        <button type="button" id="searchIngBtn"  data-tag="search_adv"></button><br />
        <input type="submit" class="inputhidden" value="Submit" />
		<br />
		<br />
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
            <tr id="<?php echo $recipe_item['_recipeID']; ?>">
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