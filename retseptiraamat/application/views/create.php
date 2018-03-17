
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?php
        echo "<h2>Siia tuleb retsepti lisamine.</h2>";
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?php echo validation_errors(); ?>

        <?php echo form_open('create/index', 'enctype="multipart/form-data"'); ?>

        <label for="title">Sisesta pealkiri:</label>
        <input type="text" name="title" /><br />

        <label for="imageUpload">Sisesta pilt:</label>
        <input type="file" name="imageUpload" id="imageUpload">
        <img src="../../application/assets/example_img.jpg" id="showImage" alt="Contect Image"><br />

        <label >Lisa retsepti koostisosad:</label><br />
        <input type="text" id="addIngredient" name="addIngredient" placeholder="Sisesta toiduaine"/>
        <input type="text" id="addAmount" name="addAmount" placeholder="Sisesta kogus"/>
        <input type="text" id="addUnit" name="addUnit" placeholder="Sisesta ühik"/>
        <button type="button" id="addIng" >Lisa</button><br />

        <label >Lisatud koostisosad:</label>
        <ul id="addedIngList" ></ul>
        <br />
        <label for="text">Sisesta juhend:</label><br />
        <textarea name="text" id="text"></textarea><br />

        <input type="submit" name="submit" value="Lisa uus retsept" />
        <br />
        <br />
        <br />
        <br />
        <br />

    </form>
    </div>
</div>