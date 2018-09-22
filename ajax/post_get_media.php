<?php
chdir('../');
require_once('config.php');
require_once('includes/bootstrap.php');

$post=new Post;
$post_id=(int)$_REQUEST['post_id'];
$post->getById($post_id);
$post->drawMediaAjax();
?>