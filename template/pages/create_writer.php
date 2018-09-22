<?php
define('_mode','create_writer');
define('_page_title','Do a tex of your very own');

if(isset($_POST['submit-post'])){
    $artist=new Artist;
    $artist_id=$artist->current_user;
    $name=$_POST['post-name'];
    $description=htmlspecialchars($_POST['post-description']);
    
    $post=new Post;
    $post->name=$name;
    $post->artist=$artist_id;
    $post->description=$description;
    $post->type='txt';
    $post->content=str_replace("'","\'",htmlspecialchars($_POST['content']));
    $post->timestamp=time();
    $newId=$post->add();
    if($newId>0){
        header("Location:"._base_url."post/$newId/");
        die();
    }

    
}

require_once('template/header.php');
?>

    <div id="create-container"><br>
        <form action="" method="post" class="form-controls">
            
            <div class="col-sm-9 col-md-10">
                
                <textarea class="writer" name="content"></textarea>
                
            </div>
            
            <div class="col-sm-3 col-md-2">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="post-name" />
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea rows="5" name="post-description"></textarea>
                </div>
                
                <input type="submit" name="submit-post" value="Post" />
            </div>
            
        </form>
    </div>
        
<?php
require_once('template/footer.php');