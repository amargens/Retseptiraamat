

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2 data-tag="header" id="header"></h2>
        
        <div class="col-md-3">
            
            <nav class="navbar navbar-default" id="menunav">
                <div class="container-fluid">
                    <ul class="nav navbar-nav nav-stacked" id="menu" > 
                        <li><a href="<?php echo base_url();?>index.php/account/savedrec" id="favres" data-tag="favres"></a> </li>
                        <li><a href="<?php echo base_url();?>index.php/account/ownrec" id="userres"  data-tag="userres"></a> </li>
                        <li><a href="<?php echo base_url();?>index.php/account/account" id="accset"  data-tag="accset"></a> </li>
                
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
                        <button type='button' class='btn btn-warning' onclick="window.location.href='<?php echo base_url(); ?>index.php/account/favbtn/<?php echo $favrecipes_item['_recipeID'];?>'" data-tag='favbtn'><img src='../../application/assets/ic_favorite_white_24dp.png' alt='like'></button>
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
                        <button type='button' class='btn btn-danger' onclick="window.location.href='<?php echo base_url(); ?>index.php/account/ownbtndel/<?php echo $userrecipes_item['_recipeID'];?>'" data-tag='delbtn'><img src='../../application/assets/ic_delete_white_24dp.png' alt='like'></button>
                        <p class="readmore" ><a href="<?php echo base_url();?>index.php/Recipe/view/<?php echo $userrecipes_item['_recipeID'];?>" data-tag="readmore"></a></p>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            
            
            <div class="<?php if ($menu === "account"){echo "";} else {echo "inputhidden";} ?>" id="accsetcont">
                <h3 data-tag="accset"></h3>
                
                <div class="row space">
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
                
                <div class="row space">
                    <div class="col-md-8">
                        <div id="delallrecipes" class="">
                            <h4 data-tag="delallrecipes"></h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type='button' class='btn btn-danger' onclick="window.location.href='<?php echo base_url(); ?>index.php/account/ownbtndel/all'" data-tag='delbtn'><img src='../../application/assets/ic_delete_white_24dp.png' alt='like'></button>
                    </div>
                </div>
                
                <div class="row space">
                    <div class="col-md-8">
                        <label for="checkallrecipes">
                            <h5 data-tag="checkallrecipes" ></h5>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label class="btn btn-default" for="checkallrecipes">
                            <img id="checkallimg" src='../../application/assets/ic_check_black_18dp.png' alt='like'>
                        </label>
                        <input type="checkbox" id="checkallrecipes" class="inputhidden" checked>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div id="delaccount" class="">
                            <h4 data-tag="delaccount"></h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type='button' id="accountbtndelall" class='btn btn-danger' onclick="window.location.href='<?php echo base_url(); ?>index.php/account/accountbtndel/all'" data-tag='delaccountbtn'></button>
                        <button type='button' id="accountbtndelkeepall" class='btn btn-danger inputhidden' onclick="window.location.href='<?php echo base_url(); ?>index.php/account/accountbtndel/keepall'" data-tag='delaccountbtn'></button>
                    </div>
                </div>
                
                <div class="row space">
                    <div class="col-md-8">
                        <div id="" class="">
                            <h4 data-tag="changepass"></h4>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type='button' id="changepassbegin" class='btn btn-default' data-tag='changepassbtn'></button>
                    </div>
                </div>
                
                <div id="changepass" class="row inputhidden">
                    <form method="post" id="formchangepass" name="formchangepass" accept-charset="utf-8" action="<?php echo base_url().'index.php/account/changepassbtn'; ?>">
                        
                    <div class="row">
                        <div class="col-md-8">
                            <div id="" class="">
                                <h5 data-tag="changeoldpass"></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="password" id="oldpass" name="oldpass" class="form-control" data-tag="oldpass" required autofocus>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div id="" class="">
                                <h5 data-tag="changeoldpassagain"></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="password" id="oldpassagain" name="oldpassagain" class="form-control" data-tag="oldpass" required autofocus>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div id="" class="">
                                <h5 data-tag="changenewpass"></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <input type="password" id="newpass" name="newpass" class="form-control" data-tag="newpass" required autofocus>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <button type="button" id="changepasscancel" class='btn btn-default' data-tag='changepasscancel'></button>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" id="changepassbtn" class='btn btn-primary' data-tag='savepassbtn'></button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                
            </div>
                
        </div>
        
    </div>
    
</div>

