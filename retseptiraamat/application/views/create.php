<!DOCTYPE html>

<div class="col-md-offset-4">
    <?php
    echo "<h2>Siia tuleb retsepti lisamine.</h2>";
    ?>
</div>

<div class="col-md-offset-4">
    <?php echo validation_errors(); ?>

    <?php echo form_open('create/index', 'enctype="multipart/form-data"'); ?>

    <label for="title">Sisesta pealkiri:</label>
    <input type="input" name="title" /><br />
    
    <label for="image">Sisesta pilt:</label>
    <input type="file" name="imageUpload" id="imageUpload">
    <img src="../../application/assets/example_img.jpg" id="showImage" alt="Contect Image"><br />
    
    <label >Lisa retsepti koostisosad:</label><br />
    <input type="input" id="addIngredient" name="addIngredient" placeholder="Sisesta toiduaine"/>
    <input type="input" id="addAmount" name="addAmount" placeholder="Sisesta kogus"/>
    <input type="input" id="addUnit" name="addUnit" placeholder="Sisesta ühik"/>
    <button type="button" id="addIng" >Lisa</button><br />
    
    <label >Lisatud koostisosad:</label>
    <ul id="addedIngList" ></ul>
    <br />
    <label for="text">Sisesta juhend:</label><br />
    <textarea name="text"></textarea><br />
    
    <input type="submit" name="submit" value="Lisa uus retsept" />
    <br />
    <br />
    <br />
    <br />
    <br />

</form>
</div>