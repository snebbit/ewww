<?php
define('_mode','login');
define('_page_title','reeeeeeeeeeeeeeeeeeeeeeeeeeeeee');

$artist=new Artist;

if(isset($_POST['login-submit'])){
    $name=htmlspecialchars($_POST['login-name']);
    $pass=htmlspecialchars($_POST['login-password']);
    $artist->checkLogin($name,$pass);
}

require_once('template/header.php');
?>

    <div class="container">
        
        <form class="form-controls" method="post" action="login/">
            
            <div class="form-group">
                <label>name</label>
                <input type="text" name="login-name" />
            </div>
            
            <div class="form-group">
                <label>pass</label>
                <input type="password" name="login-password" />
            </div>
            
            <div class="form-group">
                <input type="submit" name="login-submit" value="Login" />
            </div>
            
            
        </form>
        
    </div>
        

<?php
require_once('template/footer.php');