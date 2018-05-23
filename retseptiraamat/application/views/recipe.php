<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <ol class="breadcrumb">
            <li><a href="#">Avaleht</a></li>
            <li><a href="#">Otsing</a></li>
            <li class="active">Retsept</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 data-tag="header"></h2>
        
        <div class="row">
            <h3 class="col-md-8"><?php echo $recipe[0]['_title']; ?></h3>

            <div class="text col-md-4">
            <?php if($this->session->userdata('sisselogitud')) : ?>
                <form method="post" role="form" id="formfav" name="formfav" action="<?php echo base_url(); ?>index.php/recipe/favbtn/<?php echo $index; ?>" accept-charset="utf-8">
                    
                    <?php 
                    $fav = explode(',' ,$favourites[0]['favourites']);
                    $key = array_search ($index, $fav);
                    if ($key === FALSE) {
                        echo "<button type='button' id='favbtn' class='btn btn-light' data-tag='favbtn'><img src='../../../application/assets/ic_favorite_border_black_24dp.png' alt='like'></button><br />";
                        echo "<input type='text' class='inputhidden' name='favbtn' value='off' />";
                    } else {
                        echo "<button type='button' id='favbtn' class='btn btn-warning' data-tag='favbtn'><img src='../../../application/assets/ic_favorite_white_24dp.png' alt='like'></button><br />";
                        echo "<input type='text' class='inputhidden' name='favbtn' value='on' />";
                    }
                    ?>
                    
                    <input type="text" class="inputhidden" name="index" value="<?php echo $index; ?>" />
                    <input type="submit" class="inputhidden" value="Submit">
                </form>
            <?php endif; ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-7 col-md-push-5">
                <?php if ( file_exists(APPPATH.'assets/recipe_img/'.$recipe[0]['_imgpath'])) {
                    $source = '../../../application/assets/recipe_img/'.$recipe[0]['_imgpath'];
                    echo "<img src='".$source."' id='showImage' alt='Contect Image'>";
                }
                else {
                    echo "<img src='../../../application/assets/example_img.jpg' id='showImage' alt='Contect Image'>";
                }
                ?>
            </div>
            <div class="col-md-5 col-md-pull-7">
                <?php foreach ($recipe as $recipe_item): ?>

                    <div class="text">
                    <?php echo $recipe_item['_ingredient']; ?>
                    <?php echo $recipe_item['_amount']; ?>
                    <?php echo $recipe_item['_unit']; ?>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
       
        <div class="text col-md-6">
            <?php echo $recipe[0]['_text']; ?>
        </div>
    </div>
    
</div>

