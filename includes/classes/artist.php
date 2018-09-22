<?php

class Artist extends Ewww{
    
    public $id;
    public $name;
    public $current_user=false;
    public $current_user_name=false;
    
    function __construct(){
        @session_start();
        if(!isset($_SESSION['user']) AND _mode!='login'){
            header("Location:"._base_url."login/");
            die();
        }
        else{
            $this->current_user=$_SESSION['user'];
            $this->current_user_name=$this->getNameById($this->current_user);
        }
    }
    
    function checkLogin($name,$pass){
        $md5=md5($pass);
        $result=$this->query("select artist_id from artists where name='$name' and pass='$md5' limit 1");
        $resultArray=$result->fetch_assoc();
        print_r($resultArray);
        if($resultArray['artist_id']>0){
            $_SESSION['user']=$resultArray['artist_id'];
            header("Location:"._base_url);
            die();
        }
        else return false;
    }
    
    function generateCache(){
        if(!file_exists('var/cache/summits.cache')){
            $summits=$this->getAllSummits();
            $myfile = fopen("var/cache/summits.cache", "w") or die("Unable to open file!");
            fwrite($myfile, json_encode($summits));
            fclose($myfile);
        }
    }
    
    function getAllArtists($random=true){
        $outArray=array();
        if($random) $result=$this->query("select * from artists order by rand()");
        else $result=$this->query("select * from artists order by name asc");
        while($resultArray=$result->fetch_assoc()){
            $outArray[]=$resultArray;
        }
        return $outArray;
    }
    
    function getNameById($id){
        $this->id=$id;
        $result=$this->query("select name from artists where artist_id='$this->id' limit 1");
        $resultArray=$result->fetch_assoc();
        return $resultArray['name'];
    }
    
    function getById($id){
        $this->id=$id;
        $result=$this->query("select * from artists where region_id='$this->id' limit 1");
        $resultArray=$result->fetch_assoc();
        $this->name=$resultArray['name'];
        $this->image_bg=$resultArray['image_bg'];
        $this->image_bg_attribution=$resultArray['image_bg_attribution'];
    }
    
    function drawLabel($id,$name){
        ?><span class="user-label"><img src="media/avatars/<?php echo $id;?>.png" class="user-icon" /> <?php echo $name;?></span><?php
    }
    
    function drawMiniLabel($id,$name){
        ?><span class="user-label-mini"><img src="media/avatars/<?php echo $id;?>.png" class="user-icon user-icon-mini" /> <?php echo $name;?></span><?php
    }
    
    function changePassword($oldPass,$newPass){
        $md5old=md5($oldPass);
        $md5new=md5($newPass);
        $result=$this->query("select artist_id from artists where artist_id='$this->current_user' and pass='$md5old' limit 1");
        if($result->num_rows==1){
            $result=$this->query("update artists set pass='$md5new' where artist_id='$this->current_user' limit 1");
            return true;
        }
        else return false;
    }
    
    function receiveAvatar($image,$image_temp,$type='png'){
        require_once('includes/imagecropper.php');
        $upload_image_tmp_filename = $image_temp;
        $file_extension = pathinfo($image, PATHINFO_EXTENSION);
        $type=strtolower($file_extension);
        
        $allowedTypes=array('png');
        if(!in_array($type,$allowedTypes)) die();
        
        $max_width = 50;
        $max_height = 50;
        
        //$picture = New Image($upload_image_tmp_filename);
        
        $filename=$this->current_user.'.png';
        $saveas_image_filename = 'media/avatars/'.$filename;
        move_uploaded_file($image_temp, 'media/avatars/'.$filename);
        
        $picture = New Image('media/avatars/'.$filename);
        $picture->saveFile($saveas_image_filename, $max_width, $max_height, True);
        @session_start();
    }
    
    
    
}





?>