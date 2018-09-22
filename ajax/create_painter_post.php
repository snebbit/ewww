<?php
chdir('../');
require_once('config.php');
require_once('includes/bootstrap.php');

$post=new Post;
$post->receiveImage($_FILES['picture']['name'],$_FILES['picture']['tmp_name']);
echo 'CHIBIOK';
?>