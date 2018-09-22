<?php
chdir('../');
require_once('config.php');
require_once('includes/bootstrap.php');

$remember=new Remember;
$remember->post_id=(int)$_POST['post_id'];
$artist=new Artist;
$remember->artist_id=$artist->current_user;
$remember->timestamp=time();
$remember->add();

?>