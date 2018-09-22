<?php

class Post extends Ewww{
    
    public $id;
    public $name;
    public $description;
    public $artist_id;
    public $artist_name;
    public $timestamp;
    public $type='jpg';
    public $content;
    
    function __construct(){
        
    }
    
    function getById($id){
        $this->id=$id;
        $result=$this->query("select *,posts.name as name,artists.name as artist_name from posts left join artists on artists.artist_id=posts.artist where post_id='$this->id' limit 1");
        $resultArray=$result->fetch_assoc();
        $this->name=$resultArray['name'];
        $this->description=$resultArray['description'];
        $this->type=$resultArray['type'];
        $this->content=$resultArray['content'];
        $this->artist_name=$resultArray['artist_name'];
        $this->artist_id=$resultArray['artist_id'];
        $this->timestamp=$resultArray['timestamp'];
    }
    
    function populate($resultArray){
        $this->id=$resultArray['post_id'];
        $this->name=$resultArray['name'];
        $this->description=$resultArray['description'];
        $this->type=$resultArray['type'];
        $this->content=$resultArray['content'];
        $this->artist_name=$resultArray['artist_name'];
        $this->artist_id=$resultArray['artist_id'];
        $this->timestamp=$resultArray['timestamp'];
    }
    
    function getAllPosts(){
        $outArray=array();
        $result=$this->query("select * from posts order by post_id desc");
        while ($post=$result->fetch_assoc()) {
            $outArray[]=$post;
        }
        return $outArray;
    }
    
    function getTotalPosts(){
        $result=$this->query("select post_id from posts");
        return $result->num_rows;
    }
    
    function viewPost($id=null){
        if($id) $this->id=$id;
        $this->getById($this->id);
        
        echo '<h1>'.$this->name.'</h1>';
        
    }
    
    function drawPostcard(){
        ?>
        <div class="post-card">
            
            <?php $artistInstance=new Artist; $artistInstance->drawMiniLabel($this->artist_id,$this->artist_name);?>
            
            <a href="post/<?php echo $this->id;?>/" data-href="post/<?php echo $this->id;?>/" data-postid="<?php echo $this->id;?>" class="post-link">
                <?php
        switch($this->type){
            
            case 'base64':
                echo '<img src="data:image/png;base64,'.$this->content.'" class="img-responsive" />';
            break;
            
            case 'png':
                if(file_exists('media/content/thumbs/'.$this->content)) echo '<img src="media/content/thumbs/'.$this->content.'" class="img-responsive" />';
                else echo '<img src="media/content/'.$this->content.'" class="img-responsive" />';
            break;
            
            case 'jpg':
                if(file_exists('media/content/thumbs/'.$this->content)) echo '<img src="media/content/thumbs/'.$this->content.'" class="img-responsive" />';
                else echo '<img src="media/content/'.$this->content.'" class="img-responsive" />';
            break;
            
            case 'gif':
                if(file_exists('media/content/thumbs/'.$this->content)) echo '<img src="media/content/thumbs/'.$this->content.'" class="img-responsive" />';
                else echo '<img src="media/content/'.$this->content.'" class="img-responsive" />';
            break;
            
            case 'txt':
                echo '<div class="writing-presentation">'.nl2br(substr($this->content,0,200)).'</div>';
            break;
            
        }
        ?>
            </a>
            <h5>
                <?php
                $commentInstance=new Comment;
                $total=$commentInstance->getTotalCommentsForPost($this->id);
                if($total<1) $buttonText='Draw a Comment';
                else{
                    $buttonText=$total.' comment';
                    if($total>1) $buttonText.='s';
                }
                ?>
                <button class="btn-xs post-link" data-href="post/<?php echo $this->id;?><?php echo $this->id;?>/" data-postid="<?php echo $this->id;?>"><?php echo $buttonText;?></button>
                
                
                <?php echo $this->name;?> 
            </h5>
            
    		<?php /*
    		<div id="comments">
    		    <?php
    		    $postComments=$commentInstance->getAllCommentsForPost(1);
    		    $commentInstance->drawComments($postComments);
    		    ?>
    		</div>*/ ?>
            
        </div>
        <?php
    }
    
    function add(){
        $result=$this->query("insert into posts (artist,type,content,timestamp,name,description) values ('$this->artist','$this->type','$this->content','".time()."','$this->name','$this->description');");
        return mysqli_insert_id($this->db);
    }
    
    function receiveImage($image,$image_temp,$type='png'){
        require_once('includes/wordzz.php');
        require_once('includes/imagecropper.php');
        $upload_image_tmp_filename = $image_temp;
        $file_extension = pathinfo($image, PATHINFO_EXTENSION);
        $type=strtolower($file_extension);
        
        if(strlen($type)<1) $type='png';
        
        $allowedTypes=array('jpg','jpeg','gif','png');
        if(!in_array($type,$allowedTypes)) die();
        if($type=='jpeg') $type='jpg';
        
        $max_width = 360;
        $max_height = 270;
        
        $picture = New Image($upload_image_tmp_filename);
        
        $filename=generateRandomSlug().'.'.$type;
        $saveas_image_filename = 'media/content/thumbs/'.$filename;
        move_uploaded_file($image_temp, 'media/content/'.$filename);
        
        $picture = New Image('media/content/'.$filename);
        $picture->saveFile($saveas_image_filename, $max_width, $max_height, True);
        @session_start();
        $_SESSION['create_filename']=$filename;
        $_SESSION['create_type']=$type;
    }
    
    function checkIfRemembered(){
        $artistInstance=new Artist;
        $result=$this->query("select remember_id from remembers where post='$this->id' AND artist='$artistInstance->current_user' limit 1");
        if($result->num_rows>0) return true;
        else return false;
    }
    
    
    function drawCommentsAjax(){
        ?>
        <script>var imageSource=$('#post-media-main').attr('src');</script>
        <br>
        <div class="btn-group">
            <button class="btn btn-small btn-primary" id="draw-btn<?php echo $this->id;?>" class="draw-btn"><span><i class="glyphicon glyphicon-pencil"></i> Comment</span></button>
            <button class="btn btn-small btn-primary" onclick="var win = window.open(imageSource, '_blank');win.focus();"><i class="glyphicon glyphicon-zoom-in"></i> Fullsize</button>
            <?php if($this->checkIfRemembered()){ ?>
                <button class="btn btn-small btn-active btn-success" onclick="removeRemember(<?php echo $this->id;?>,this)"><i class="glyphicon glyphicon-star yellow"></i> Collect</button>
            <?php } else {?>
                <button class="btn btn-small btn-primary" onclick="addRemember(<?php echo $this->id;?>,this)"><i class="glyphicon glyphicon-star-empty"></i> Collect</button>
            <?php } ?>
            <button class="btn btn-small btn-primary" onclick="copyUrl();" id="copy-url-button"><i class="glyphicon glyphicon-link"></i> URL</button>
            <span style="opacity:0" id="select-url"><?php echo _base_url.'media/content/'.$this->content;?></span>
        </div>
        <br><br> 
        <div id="comments">
            <?php
		    $commentInstance=new Comment;
		    $postComments=$commentInstance->getAllCommentsForPost($this->id);
		    $commentInstance->drawComments($postComments);
		    ?>
        </div>
        
        <div style="overflow:hidden;" id="painter-parent">
            <div id="painter<?php echo $this->id;?>">
    			
    		</div>
    	</div>
    	<br>
    	
    	<script type="text/javascript">
	                function addRemember(postid,el){
                        $postVals={'post_id':postid};
                        $comments=$.post('ajax/remember.php',$postVals,function(data){
                    	    $(el).addClass('btn-active').addClass('btn-success');
                    	    $(el).find('i').addClass('glyphicon-star').addClass('yellow').removeClass('glyphicon-star-empty');
                    	},'text');
                    }
                    
                    function removeRemember(postid,el){
                        $postVals={'post_id':postid};
                        $comments=$.post('ajax/remember_remove.php',$postVals,function(data){
                    	    $(el).addClass('btn-primary').removeClass('btn-success');
                    	    $(el).find('i').removeClass('glyphicon-star').removeClass('yellow').addClass('glyphicon-star-empty');
                    	},'text');
                    }
                    
                    function selectText(element) {
                        var doc = document;
                        var text = doc.getElementById(element);    
                    
                        if (doc.body.createTextRange) { // ms
                            var range = doc.body.createTextRange();
                            range.moveToElementText(text);
                            range.select();
                        } else if (window.getSelection) { // moz, opera, webkit
                            var selection = window.getSelection();            
                            var range = doc.createRange();
                            range.selectNodeContents(text);
                            selection.removeAllRanges();
                            selection.addRange(range);
                        }
                    }
                    
                    function copyUrl(){
                        selectText('select-url');
                        var copied=document.execCommand('copy');
                        if(copied){
                            $('#copy-url-button').addClass('btn-success');
                            $('#copy-url-button').find('i').addClass('yellow').addClass('glyphicon-check').removeClass('glyphicon-link');
                            setTimeout(function(){
                                $('#copy-url-button').removeClass('btn-success',500);
                                $('#copy-url-button').find('i').removeClass('yellow',500).removeClass('glyphicon-check').addClass('glyphicon-link');
                            },1300)
                        }
                    }
                        
    			    $(document).ready(function(){
    			       $('#painter<?php echo $this->id;?>').hide();
    			       $('#draw-btn<?php echo $this->id;?>').click(function(){
    			           $('#painter<?php echo $this->id;?>').show();
    			           $('#painter<?php echo $this->id;?>').data('postid','<?php echo $this->id;?>');
    			           //location.hash = '#painter<?php echo $this->id;?>';
    			           Ritare.start({
            					parentel: "painter<?php echo $this->id;?>",
            					onFinish: function(e) {
            					    $base64=Ritare.canvas.toDataURL('image/png');
            					    $base64.replace('data:image/png;base64,','');
            					    $postId=$('#painter<?php echo $this->id;?>').data('postid');
            					    $postVals={'post_id':$postId,'base64':$base64}
            					    $.post('ajax/comment_add.php',$postVals);
            						$('#painter<?php echo $this->id;?>').hide();
            						$('#painter<?php echo $this->id;?>').remove();
            						
                                	$comments=$.post('ajax/post_get_comments.php',$postVals,function(data){
                                	    $('#comments-container').html(data);
                                	},'text');
            					},
            					width:300,
            					height:125
            				});
            				$("#picker").spectrum({
                                color: "#000",
                                showInput: false,
                                showButtons: false,
                                change: function(color) {
                                    Ritare.color=color.toHexString();
                                    Ritare.colors=color.toRgb();
                                    Ritare.colors[0]=Ritare.colors['r'];
                                    Ritare.colors[1]=Ritare.colors['g'];
                                    Ritare.colors[2]=Ritare.colors['b'];
                                },
                                move: function(color) {
                                    Ritare.color=color.toHexString();
                                    Ritare.colors=color.toRgb();
                                    Ritare.colors[0]=Ritare.colors['r'];
                                    Ritare.colors[1]=Ritare.colors['g'];
                                    Ritare.colors[2]=Ritare.colors['b'];
                                }
                            });
            				$('#draw-btn<?php echo $this->id;?>').off('click');
            				
    			       });
    			       
    			       $("#picker").spectrum({
                            color: "#f00",
                            flat: 'true'
                        });

                        
    			       
    			       
    			    });
    				
    			</script>
        <?php
    }
    
    function drawMediaAjax(){
        ?>
        <h4>
            <?php
            $artistInstance=new Artist;
            $artistInstance->drawLabel($this->artist_id,$this->artist_name);
            echo ' '.$this->name;?>
        </h4>
        <?php
        switch($this->type){
            
            case 'base64':
                echo '<img src="data:image/png;base64,'.$this->content.'" class="img-responsive" id="post-media-main" />';
            break;
            
            case 'png':
                echo '<img src="media/content/'.$this->content.'" class="img-responsive" id="post-media-main" />';
            break;
            
            case 'jpg':
                echo '<img src="media/content/'.$this->content.'" class="img-responsive" id="post-media-main" />';
            break;
            
            case 'gif':
                echo '<img src="media/content/'.$this->content.'" class="img-responsive" id="post-media-main" />';
            break;
            
            case 'txt':
                echo '<div class="writing-presentation">'.nl2br($this->content).'</div>';
            break;
            
        }
        ?>
        <p>
        <b>Posted:</b> <?php echo date('jS M Y H:i',$this->timestamp);?>
        </p>
        <p>
        <?php echo nl2br($this->description);?>
        </p>
        <?php
    }
    
    
}