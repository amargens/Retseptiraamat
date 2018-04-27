
<div class="container inputhidden" id="changeerror">
    <p class="alert alert-danger" data-tag="changeerror"></p>
</div>
<div class="container inputhidden" id="inputerror">
    <p class="alert alert-danger" data-tag="inputerror"></p>
</div>
<div class="container inputhidden" id="changesuccess">
    <p class="alert alert-success" data-tag="changesuccess"></p>
</div>

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 data-tag="header" id="header"></h2>
        
        <div class="col-md-3">
            
            <nav class="navbar navbar-default" id="menunav">
                <div class="container-fluid">
                    <ul class="nav navbar-nav nav-stacked" id="menu" > 
                        <li><a href="#header" id="favres" data-tag="favres"></a> </li>
                        <li><a href="#header" id="userres"  data-tag="userres"></a> </li>
                        <li><a href="#header" id="accset"  data-tag="accset"></a> </li>
                
                    </ul>
                </div>
            </nav>
            
        </div>
        
        <div class="col-md-9">
            <div class="" id="favrescont">
                <h3 data-tag="favres"></h3>
                
                <?php if ($favrecipes === NULL): ?>
                <h5 data-tag="nofavres"></h5>
                
                <?php else: ?>
                <?php foreach ($favrecipes as $favrecipes_item): ?>
                <div class="tabrow row">
                    <div class="tabcol col-md-3">
                        <?php if ( file_exists(APPPATH.'assets/recipe_img/'.$favrecipes_item['_imgpath'])) {
                                $source = '../../application/assets/recipe_img/'.$favrecipes_item['_imgpath'];
                                echo "<img src='".$source."' class='img-thumbnail' alt='Contect Image'>";
                            }
                            else {
                                echo "<img src='../../application/assets/example_img.jpg' class='showImage' alt='Contect Image'>";
                            }
                        ?>
                    </div>
                    <div class="tabcol col-md-6">
                        <h4><?php echo $favrecipes_item['_title']; ?></h4>
                        <div class="text">
                            <?php echo mb_substr($favrecipes_item['_text'], 0, 150) . "..."; ?>
                        </div>
                    </div>
                    <div class="tabcol col-md-3 extra">
                        <button type='button' class='favbtnon' onclick="window.location.href='<?php echo base_url(); ?>index.php/account/favbtn/<?php echo $favrecipes_item['_recipeID'];?>'" data-tag='favbtn'><img src='../../application/assets/ic_favorite_black_24dp.png' alt='like'></button>
                        <p class="readmore" ><a href="<?php echo base_url();?>index.php/Recipe/view/<?php echo $favrecipes_item['_recipeID'];?>" data-tag="readmore"></a></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            
            <div class="inputhidden" id="userrescont">
                <h3 data-tag="userres"></h3>
                
                <?php if ($userrecipes === NULL): ?>
                <h5 data-tag="nouserres"></h5>
                
                <?php else: ?>
                <?php foreach ($userrecipes as $userrecipes_item): ?>
                <div class="tabrow row">
                    <div class="tabcol col-md-3">
                        <?php if ( file_exists(APPPATH.'assets/recipe_img/'.$userrecipes_item['_imgpath'])) {
                                $source = '../../application/assets/recipe_img/'.$userrecipes_item['_imgpath'];
                                echo "<img src='".$source."' class='img-thumbnail' alt='Contect Image'>";
                            }
                            else {
                                echo "<img src='../../application/assets/example_img.jpg' class='showImage' alt='Contect Image'>";
                            }
                        ?>
                    </div>
                    <div class="tabcol col-md-6">
                        <h4><?php echo $userrecipes_item['_title']; ?></h4>
                        <div class="text">
                            <?php echo mb_substr($userrecipes_item['_text'], 0, 150) . "..."; ?>
                        </div>
                    </div>
                    <div class="tabcol col-md-3 extra">
                        
                        <p class="readmore" ><a href="<?php echo base_url();?>index.php/Recipe/view/<?php echo $userrecipes_item['_recipeID'];?>" data-tag="readmore"></a></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            
            
            <div class="inputhidden" id="accsetcont">
                <h3 data-tag="accset"></h3>
                
                <div class="col-md-8">
                    <input type="text" class="form-control" id="idnuminput" data-tag="changeidnum" placeholder="Recipient's username">
                </div>
                <div class="col-md-4">
                    <button class="btn btn-outline-secondary" id="idnumbtn" type="button" data-tag="changesave"></button>
                </div>
                
            </div>
                
        </div>
        
    </div>
    
</div>

