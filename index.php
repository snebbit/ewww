<?php
// Chewitts
// Hewitt Tracker by Tom Calpin

require_once('config.php');
require_once('includes/bootstrap.php');

if(!isset($_GET['login'])){
    $artistInstance=new Artist;
    global $artistInstance;
}

// TODO: a proper router
if(isset($_GET['feed'])) require_once('template/pages/feed.php');
if(isset($_GET['create'])) require_once('template/pages/create.php');
elseif(isset($_GET['create_upload'])) require_once('template/pages/create_upload.php');
elseif(isset($_GET['create_painter'])) require_once('template/pages/create_painter.php');
elseif(isset($_GET['create_painter_post'])) require_once('template/pages/create_painter_post.php');
elseif(isset($_GET['create_writer'])) require_once('template/pages/create_writer.php');
elseif(isset($_GET['search'])) require_once('template/pages/search.php');
elseif(isset($_GET['login'])) require_once('template/pages/login.php');
elseif(isset($_GET['logout'])) require_once('template/pages/logout.php');
elseif(isset($_GET['settings'])) require_once('template/pages/settings.php');
else  require_once('template/pages/feed.php');

require_once('template/footer.php');
?>