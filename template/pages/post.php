<?php
$post_id=(int)$_GET['post'];
$post=new Post;
$post->getById($post_id);
define('_mode','post');
define('_post_id',$post_id);
define('_page_title',$post->name.' by ');

require_once('template/header.php');

?>
<div class="container post">
    <div class="row">
            
        <div class="col-md-8">
            <?php
            
            echo '<div class="row alert alert-info">';
                echo '<div class="col-md-3">';
                    
                echo '</div>';
                echo '<div class="col-md-9">';
                        echo '<h1>'.$post->name.'</h1>';
                echo '</div>';
                
            echo '</div>';


            //$bagInstance=new Bag;
            //$bags=$bagInstance->getBagsBySummit($summit->id);
            
            //foreach($bags as $bag){
                
            //}
            
            if(count($bags)==0){
                echo '<br><br><p class="alert alert-warning">No bags of this summit yet.</p>';   
            }

            
            
            ?>
        </div>
        
        <div class="col-md-4">
            <div class="alert alert-success">
                    <?php
                    echo $summit->grid_sheet.' '.$summit->grid_north.' '.$summit->grid_east;
                    echo '<br>'.$summit->latitude.','.$summit->longitude;
                    echo '<h5>Region: <a href="region/'.$summit->region_id.'/">'.$summit->region_name.'</a></h5>';
                    echo '<h5>Altitude: '.$summit->altitude.'m</h5>';
                    ?>
                    
            </div>
        </div>
        
    </div>
</div>

<?php

require_once('template/footer.php');