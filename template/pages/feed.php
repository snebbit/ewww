<?php
if(isset($_GET['remember'])) define('_mode','collection');
else define('_mode','feed');
define('_page_title','Feed');

require_once('template/header.php');

$post=new Post;
$post->getById(1);
?> 

<div id="feed" class="container">
    
    <?php
    $feed=new Feed;
    if(_mode=='collection') $feed->collection=true;
    $feed->drawPostcards(36,0);
    ?>

</div>

<div id="post-modal">
    <a href="#" class="post-modal-close post-modal-bgclick">&nbsp;</a>
    
    <div id="post-modal-inner">
        
        <div class="post">
            <div class="row">
                <div class="col-sm-7 col-md-8 col l">
                    <div id="post-media">
                        <?php $post->drawMediaAjax();?>
                    </div>
                </div>
                <div class="col-sm-5 col-md-4 alert-info comments-bg">
                    <div id="comments-container">
                        <?php $post->drawCommentsAjax();?>
                	</div>
                </div>
            </div>
        </div>
        
        <button class="btn btn-small btn-danger post-modal-close modal-x"><i class="glyphicon glyphicon-remove"></i></button>
    </div>
    
    <a href="#" class="post-modal-close post-modal-bgclick">&nbsp;</a>
    
    <script>
        $(document).ready(function(){
            $('.post-link').click(function(){
                $postId=$(this).data('postid');
                $postUrl=$(this).data('href');
                return openPost($postId,$postUrl);
           });
           
           function openPost(postid,posturl){
                $postId=postid;
                $postUrl=posturl;
                
                $post_id=$postId;
                $postVals={'post_id':$postId};
            	$media=$.post('ajax/post_get_media.php',$postVals,function(data){
            	    $('#post-media').html(data);
            	},'text');
            	$comments=$.post('ajax/post_get_comments.php',$postVals,function(data){
            	    $('#comments-container').html(data);
            	},'text');
            	
                var stateObj = { foo: "bar" };
                history.pushState(stateObj, "page 2", $postUrl);
                $(window).scrollTop(0);
                $('#post-modal').show(450);
                return false; 
           }
           
           $('.post-modal-close').each(function(){
               $(this).click(function(){
    	          $('#post-modal').hide(100);
    	          var stateObj = { foo: "bar" };
                  history.pushState(stateObj, "page 2", '/');
    	          return false; 
    	       });
           });
           
           $(document).keyup(function(e) {
                 if (e.keyCode == 27) {
                    $('#post-modal').hide(100);
                    var stateObj = { foo: "bar" };
                    history.pushState(stateObj, "page 2", '/');
                }
            });
            
            
            <?php if(isset($_GET['post_id'])) echo 'openPost('.(int)$_GET['post_id'].');'; ?>
        });
    </script>
</div>


<?php
require_once('template/footer.php');