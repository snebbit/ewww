<?php
define('_mode','settings');
define('_page_title','amusing title #24');

require_once('template/header.php');
?>

    <div class="container">
        
        <?php 
        if(isset($_POST['change-pass'])){
            $oldPass=$_POST['current-pass'];
            $newPass=$_POST['new-pass'];
            $artist=new Artist;
            $artist->changePassword($oldPass,$newPass);
            echo '<div class="alert alert-success">Password changed</div>';
        }
        
        
        if(isset($_POST['submit-avatar'])){
            
            $artist=new Artist;
            $artist->receiveAvatar($_FILES['avatar-file']['name'],$_FILES['avatar-file']['tmp_name']);
            echo '<div class="alert alert-success">Avatar changed</div>';
            
        }
        ?>
        
        <h3>Settings</h3>
        
        <form action="settings/" method="post" class="form-controls form-inline">
            <div class="form-group">
                <label>Current pass</label>
                <input type="password" name="current-pass" />
            </div>
            <div class="form-group">
                <label>New pass</label>
                <input type="password" name="new-pass" />
            </div>
            <div class="form-group">
                <input type="submit" name="change-pass" value="Change Password" class="btn-small btn-primary" />
            </div>
        </form>
        
        <br><br>
 
        <form class="form-controls form-inline" method="post" action="<?php echo _base_url;?>settings/" enctype="multipart/form-data">
            <div class="form-group">
                <label>File (50x50 png)</label>
                <input type="file" name="avatar-file" />
            </div>
            
            <div class="form-group">
                <input type="submit" name="submit-avatar" value="Change Avatar" class="btn-small btn-primary" />
            </div>
        </form>
        
    </div>

<?php
require_once('template/footer.php');