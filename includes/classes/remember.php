<?php

class Remember extends Ewww{
    
    public $id;
    public $artist_id;
    public $artist_name;
    public $post_id;
    public $timestamp;
    
    function __construct(){
        
    }
    
    /*function getById($id){
        $this->id=$id;
        $result=$this->query("select * from comments left join artists on artist.artist_id=comments.artist where comment_id='$this->id' limit 1");
        echo mysqli_error($this->db);
        $resultArray=$result->fetch_assoc();
        $this->base64=$resultArray['base64'];
        $this->artist_id=$resultArray['artist'];
        $this->post_id=$resultArray['post'];
        $this->timestamp=$resultArray['timestamp'];
        $this->artist_name=$resultArray['name'];
    }
    
    function populate($resultArray){
        $this->id=$resultArray['id'];
        $this->base64=$resultArray['base64'];
        $this->artist_id=$resultArray['artist'];
        $this->post_id=$resultArray['post'];
        $this->timestamp=$resultArray['timestamp'];
        $this->artist_name=$resultArray['name'];
    }
    
    function getAllComments(){
        $outArray=array();
        $result=$this->query("select * from comments left join artists on artist.artist_id=comments.artist order by comment_id desc");
        while ($comment=$result->fetch_assoc()) {
            $outArray[]=$comment;
        }
        return $outArray;
    }
    
    function getAllCommentsForPost($post_id){
        $outArray=array();
        $post_id=(int)$post_id;
        $result=$this->query("select * from comments left join artists on artists.artist_id=comments.artist where post='$post_id' order by comment_id asc");
        while ($comment=$result->fetch_assoc()) {
            $outArray[]=$comment;
        }
        return $outArray;
    }
    
    function getTotalCommentsForPost($post_id){
        $result=$this->query("select comment_id from comments where post='$post_id'");
        return $result->num_rows;
    }
    
    function drawComment(){
        echo '<div class="comment">';
            echo '<img src="data:image/png;base64,'.$this->base64.'" />';
            $artistInstance=new Artist;
            echo '<h6>';
            $artistInstance->drawMiniLabel($this->artist_id,$this->artist_name);
            echo ' | '.date('j M y H:i',$this->timestamp).'</h6>';
        echo '</div>';
    }
    
    function drawComments($array){
        echo '<div class="comments">';
        foreach($array as $comment){
            $this->populate($comment);
            $this->drawComment();
        }
        echo '</div>';
    }*/
    
    function add(){
        $result=$this->query("insert into remembers (post,artist,timestamp) values ('$this->post_id','$this->artist_id','".time()."');");
        return $result;
    }
    
    function remove(){
        if($this->artist_id>0){
        $result=$this->query("delete from remembers where post='$this->post_id' and artist='$this->artist_id'");
        return $result;
        }
    }
    
    
    
    
}