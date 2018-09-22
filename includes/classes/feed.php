<?php

class Feed extends Ewww{
    
    public $id;
    public $name;
    public $totalSummits;
    public $totalBags;
    public $image_bg;
    public $image_bg_attribution;
    public $collection=false;
    
    function __construct(){
        $this->generateCache();
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
    
    function drawPostcards($count=12,$offset=0){
        $artistInstance=new Artist;
        if($this->collection) $result=$this->query("select *,artists.name as artist_name,posts.name as name from remembers left join posts on remembers.post=posts.post_id left join artists on artists.artist_id=remembers.artist where remembers.artist='$artistInstance->current_user' order by remember_id desc limit $offset,$count");
        else $result=$this->query("select *,artists.name as artist_name,posts.name as name from posts left join artists on artists.artist_id=posts.artist order by post_id desc limit $offset,$count");
        
        $i=1;
        
        while($resultArray=$result->fetch_assoc()){
            
            if($i==1) echo '<div class="row">';
            echo '<div class="col-sm-4">';
            $post=new Post;
            $post->populate($resultArray);
            $post->drawPostcard();
            echo '</div>';
            if($i==3){ 
                echo '</div>';
                $i=1;
            }
            else $i++;
        }
        if($i>1) echo '</div>';
    }
    
    
    
    
}





?>