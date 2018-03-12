<!DOCTYPE html>

<div>
    <?php
    echo "<h2>Siia tuleb retsepti lisamine.</h2>";
    ?>
</div>

<div>
    <?php echo validation_errors(); ?>

    <?php echo form_open('create/index', 'enctype="multipart/form-data"'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" /><br />
    
    <label for="image">Image</label>
    <input type="file" name="imageUpload" id="imageUpload">
    <img src="" id="showImage" width="200px" alt="Contect Image">

    <label for="text">Text</label>
    <textarea name="text"></textarea><br />
    
    <input type="submit" name="submit" value="Lisa uus retsept" />

</form>
</div>