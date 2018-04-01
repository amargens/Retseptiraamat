
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 data-tag="header_ee"></h2>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
    <?php echo validation_errors(); ?>
        
    <form method="post" accept-charset="utf-8" action="<?php echo base_url().'index.php/create/index'; ?>" role="form" enctype="multipart/form-data" name="formCreate" id="formCreate">

        <label for="title_ee" data-tag="title_ee"></label>
        <input type="text" name="title_ee" /><br />

        <label for="imageUpload" data-tag="image_ee"></label>
        <button type="button" id="imageUploadVis" data-tag="imageUploadBtn_ee"></button>
        <p id="imageUploadvalue" data-tag="imageUploadvalue_ee"></p>
        <input type="file" name="imageUpload" id="imageUpload" class = "inputhidden">
        <img src="../../application/assets/example_img.jpg" id="showImage" alt="Contect Image"><br />

        <label  data-tag="addIng_ee"></label><br />
        <input type="text" title="addIngredient" id="addIngredient_ee" name="addIngredient_ee" placeholder="Sisesta toiduaine"/>
        <input type="text" title="addAmount" id="addAmount_ee" name="addAmount_ee" placeholder="Sisesta kogus"/>
        <input type="text" title="addUnit" id="addUnit_ee" name="addUnit_ee" placeholder="Sisesta ühik"/>
        <button type="button" id="addIng_ee"  data-tag="addbtn_ee"></button><br />

        <label  data-tag="addedIng_ee"></label>
        <ul id="addedIngList_ee" ></ul>
        <br />
        <label for="text_ee" data-tag="text_ee"></label><br />
        <textarea name="text_ee" id="text_ee"></textarea><br />
        
        <input type="checkbox" name="insert_Eng" id="insert_Eng" />
        <p data-tag="insert_Eng"></p><br>
        
        <div id="cont_Eng" class="inputhidden" >
            <h2 data-tag="header_eng"></h2><br />
            <label for="title_eng" data-tag="title_eng"></label>
            <input type="text" name="title_eng" /><br />

            <label  data-tag="addIng_eng"></label><br />
            <input type="text" title="addIngredient" id="addIngredient_eng" name="addIngredient_eng" placeholder="Sisesta toiduaine"/>
            <input type="text" title="addAmount" id="addAmount_eng" name="addAmount_eng" placeholder="Sisesta kogus"/>
            <input type="text" title="addUnit" id="addUnit_eng" name="addUnit_eng" placeholder="Sisesta ühik"/>
            <button type="button" id="addIng_eng"  data-tag="addbtn_eng"></button><br />

            <label  data-tag="addedIng_eng"></label>
            <ul id="addedIngList_eng" ></ul>
            <br />
            <label for="text_eng" data-tag="text_eng"></label><br />
            <textarea name="text_eng" id="text_eng"></textarea><br />
        </div>
        
        <input type="checkbox" name="locationBox" id="locationBox" />
        <p data-tag="locationBox"></p><br>
        
        <button type="button" id="submitRecipe" data-tag="add_recipe_ee"></button>
        
        <input type="submit" class="inputhidden" value="Submit"/>
        <br />
        <br />
        <br />
        <br />
        <br />

    </form>
    <form method="post" role="form" id="formError" name="formError" action="<?php echo base_url().'index.php/create/error'; ?>" accept-charset="utf-8">
        <input type="submit" class="inputhidden" value="Submit">
    </form>
    </div>
</div>