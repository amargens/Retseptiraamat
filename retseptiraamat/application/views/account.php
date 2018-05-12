

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
            <div class="<?php if ($menu === "savedrec"){echo "";} else {echo "inputhidden";} ?>" id="favrescont">
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
            
            
            <div class="<?php if ($menu === "ownrec"){echo "";} else {echo "inputhidden";} ?>" id="userrescont">
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
            
            
            
            <div class="<?php if ($menu === "account"){echo "";} else {echo "inputhidden";} ?>" id="accsetcont">
                <h3 data-tag="accset"></h3>
                
                <div class="row">
                    <form method="post" id="formlinkgoogle" name="formlinkgoogle" accept-charset="utf-8" action="<?php if ($gnum === FALSE){echo base_url().'index.php/account/linkGoogle';} else {echo base_url().'index.php/account/unlinkGoogle';} ?>">
                        <div class="col-md-8">
                            <?php if ($gnum === FALSE): ?>
                                <div id="linkgoogle" class="">
                                    <h4 data-tag="linkgoogle"></h4>
                                </div>
                            <?php else: ?>
                                <div id="linkedgoogle" class="">
                                    <h4 data-tag="linkedgoogle"></h4>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <?php if ($gnum === FALSE): ?>
                                <button class="btn btn-outline-secondary" id="googlebtn" type="button" data-tag="linkbtn"></button>
                            <?php else: ?>
                                <button class="btn btn-outline-secondary" id="googlebtn" type="button" data-tag="linkedbtn"></button>
                            <?php endif; ?>
                        </div>
                    <?php echo form_close(); ?>
                </div>
                
            </div>
                
        </div>
        
    </div>
    
</div>

