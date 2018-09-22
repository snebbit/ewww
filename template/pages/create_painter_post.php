<?php
define('_mode','create');
define('_page_title','Post your post');


if(isset($_POST['submit-post'])){
    $artist=new Artist;
    $artist_id=$artist->current_user;
    $name=$_POST['post-name'];
    $description=htmlspecialchars($_POST['post-description']);
    
    $post=new Post;
    $post->name=$name;
    $post->artist=$artist_id;
    $post->description=$description;
    $post->type='png';
    $post->content=$_SESSION['create_filename'];
    $post->timestamp=time();
    $newId=$post->add();
    if($newId>0){
        
        /*require_once('includes/discord.php');
        $discord_msg = '
{
    "username":"theHaus",
    "content":"bh,j,vhjvygfifyifyhkj.",
    "embeds": [{
        "title":"The Link Title",
        "description":"The Link Description",
        "url":"https://www.thelinkurl.com/",
        "color":DECIMALCOLORCODE,
        "author":{
            "name":"Site Name",
            "url":"https://www.sitelink.com/",
            "icon_url":"URLTOIMG"
        },
    }]
}
';
        $result=discordmsg($discord_msg, $webhook);
        print_r($result);*/
        
        $_SESSION['create_filename']='';
        header("Location:"._base_url."post/$newId/");
        die();
    }

    
}

require_once('template/header.php');
?>

    <div class="container" id="create-post-container">
        
        <div class="row">
            
            <div class="col-md-8">
                <?php @session_start();
        echo '<img src="media/content/'.$_SESSION['create_filename'].'" class="img-responsive" />';?>
            </div>
            
            <div class="col-md-4">
                <form class="form-controls" method="post" action="<?php echo _base_url;?>create-painter-post/">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="post-name" />
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="5" name="post-description"></textarea>
                    </div>
                    
                    <input type="submit" name="submit-post" value="Post" />
                
                </form>
                
                <br>
                <p class="alert-info text-center">
                    <ul>
                        <li><b>COMING SOON</b></li>
                        <li>Post Privacy.</li>
                        <li>Allow remixes - make your post available as a template for others to alter.</li>
                        <li></li>
                    </ul>
                </p>
            </div>
            
        </div>
        
        

    </div>

<?php
require_once('template/footer.php');