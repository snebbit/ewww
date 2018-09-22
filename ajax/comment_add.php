<?php
chdir('../');
require_once('config.php');
require_once('includes/bootstrap.php');

$comment=new Comment;
$comment->post_id=(int)$_POST['post_id'];
$artist=new Artist;
$comment->artist_id=$artist->current_user;
$comment->base64=str_replace('data:image/png;base64,','',$_POST['base64']);
$comment->timestamp=time();
$comment->add();

?>