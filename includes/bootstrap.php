<?php $classes=array(
    'abstract',
    'comment',
    'post',
    'artist',
    'feed',
    'remember'
);
foreach($classes as $classToInclude){
    require_once('includes/classes/'.$classToInclude.'.php');
}