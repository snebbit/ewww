<?php
//$post_id=(int)$_GET['post'];
//$post=new Post;
define('_mode','create');
define('_page_title','PRODUCE');

require_once('template/header.php');

?>
<div class="container">
    
    <div class="row">
        
        <div class="col-md-3">&nbsp;</div>
            
        <div class="col-md-6 text-center">
            
            <h2>PRODUCE</h2>

            <div class="btn-group btn-group-large btn-group-vertical text-left">
            <a href="create-upload/" class="btn btn-large btn-primary pull-left"><i class="glyphicon glyphicon-cloud-upload"></i> Upload a piccure</a>
            <a href="create-painter/" class="btn btn-large btn-primary pull-left"><i class="glyphicon glyphicon-pencil"></i> Draw a piccure</a>
            <a href="create-writer/" class="btn btn-large btn-primary pull-left"><i class="glyphicon glyphicon-text-color"></i> Write a tex</a>
            </div>

            <br><br>
            <p class="alert-info text-center">
                <b>COMING SOON</b><br>
                Embed posts for soundcloud/youtube/etc.<br>
                Gallery posts so pages can be grouped into a comic etc.
            </p>

        </div>
        
        <div class="col-md-3">&nbsp;</div>
        
    </div>
</div>

<?php

require_once('template/footer.php');