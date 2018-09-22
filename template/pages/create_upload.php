<?php
define('_mode','create_upload');
define('_page_title','Upload your upload');


if(isset($_POST['submit-post'])){
    
    
    $artist=new Artist;
    $artist_id=$artist->current_user;
    $name=$_POST['post-name'];
    $description=htmlspecialchars($_POST['post-description']);
    $post=new Post;
    print_r($_FILES);
    $post->receiveImage($_FILES['post-file']['name'],$_FILES['post-file']['tmp_name']);
    
    $post->name=$name;
    $post->artist=$artist_id;
    $post->description=$description;
    $post->type=$_SESSION['create_type'];
    $post->content=$_SESSION['create_filename'];
    $post->timestamp=time();
    $newId=$post->add();
    if($newId>0){
        $_SESSION['create_filename']='';
        header("Location:"._base_url."post/$newId/");
        die();
    }

    
}

require_once('template/header.php');
/*
require_once('includes/imagecropper.php');
$upload_image_tmp_filename = 'media/content/quiz-imposter-yukon.png';
$saveas_image_filename = 'media/content/quiz-imposter-yukon2.png';
$max_width = 360;
$max_height = 270;

$picture = New Image($upload_image_tmp_filename);
$picture->saveFile($saveas_image_filename, $max_width, $max_height, True);
*/
?>

    <div class="container" id="create-container">
        
        <div class="row">
            
            <div class="col-md-4">
                &nbsp;
            </div>
            
            <div class="col-md-4">
                <h4>Upload Picture</h4>
                <form class="form-controls" method="post" action="<?php echo _base_url;?>create-upload/" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>File (jpg,gif,png)</label>
                        <input type="file" name="post-file" />
                    </div>
                    
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
                
            </div>
            
            <div class="col-md-4">
                &nbsp;
            </div>
            
        </div>
        
        

    </div>

<?php
require_once('template/footer.php');