<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
    
    <head>
        <title><?php echo _site_name;?> | <?php echo _page_title;?></title>
        <base href="<?php echo _base_url;?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="https://fonts.googleapis.com/css?family=Libre+Franklin" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link href="skin/css/paper.css" rel="stylesheet" />
        <link href="skin/css/custom.css" rel="stylesheet" />
        <link href="skin/css/sortable-theme-minimal.css" rel="stylesheet" />
        <link href="skin/css/ritare.css" rel="stylesheet" />
        <link href="skin/css/spectrum.css" rel="stylesheet" />
        <?php if(_mode!='create_painter'){ ?><script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script><?php } 
        else{?>
          <script type="text/javascript">
          	if (window.PointerEvent) {
          	    window.hasNativePointerEvents = true;
          	}
          </script>
          
          <script src="includes/chickenpaint/lib/raf.js"></script>
          <script src="includes/chickenpaint/lib/es6-promise.min.js"></script>
          <script src="includes/chickenpaint/lib/jquery-2.2.1.min.js"></script>
          <script src="includes/chickenpaint/lib/pep.min.js"></script>
          <script src="includes/chickenpaint/lib/pako-1.0.1-1.min.js"></script>
          <script src="includes/chickenpaint/lib/keymaster.js"></script>
          <script src="includes/chickenpaint/lib/EventEmitter.min.js"></script>
          <script src="includes/chickenpaint/lib/FileSaver.min.js"></script>
          <script src="includes/chickenpaint/resources/js/chickenpaint.js"></script>
          <link rel="stylesheet" type="text/css" href="includes/chickenpaint/resources/css/chickenpaint.css">
        <?php } ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 
        <script src="skin/js/sortable.min.js"></script>
        <script src="skin/js/spectrum.js"></script>
        <script src="skin/js/ritare.js"></script>
    </head>
    
    <body>
        
        <div id="container">
        <?php $userInstance=new Artist; if($userInstance->current_user){?>
        <header>
            
            
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <!--<a class="navbar-brand" href="#"><img src="skin/logo-small.png" alt="CHEWITS" /></a>-->
                  <a class="navbar-brand" href="#">theHaus</a>
                </div>
            
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li class="<?php if(_mode=='feed') echo ' active';?>"><a href="/">CONSUME</a></li>
                    
                    <?php
                    /*
                    $artistInstance=new Artist;
                    $artists=$artistInstance->getAllArtists();
                    ?>
                    <li class="dropdown<?php if(_mode=='artist') echo ' active';?>">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ARTISTS <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                          <?php
                          foreach($artists as $artist){
                              echo '<li';
                              if(_mode=='artist' AND _region_id==$artist['artist_id']) echo ' class="active"';
                              echo '><a href="artist/'.$artist['artist_id'].'/">'.$artist['name'].'</a></li>';
                              
                          }
                          ?>
                      </ul>
                    </li>
                    
                    
                    
                    /*$collectionInstance=new Collection;
                    $collections=$collectionInstance->getAllCollections();
                    ?>
                    <li class="dropdown<?php if(_mode=='collection') echo ' active';?>">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">COLLECTIONS <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <?php
                          foreach($collections as $collection){
                              echo '<li';
                              if(_mode=='collection' AND _collection_id==$collection['collection_id']) echo ' class="active"';
                              echo '><a href="collection/'.$collection['collection_id'].'/">'.$collection['name'].'</a></li>';
                              
                          }
                          ?>
                      </ul>
                    </li>*/?>

                    <li class="<?php if(_mode=='create' OR _mode=='create_writer' OR _mode=='create_painter' OR _mode=='create_upload') echo ' active';?>"><a href="create/">PRODUCE</a></li>
                    <li class="<?php if(_mode=='collection') echo ' active';?>"><a href="collection/">COLLECT</a></li>
                    
                  </ul>
                  
                  <ul class="nav navbar-right">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="media/avatars/<?php $artistInstance=new Artist; echo $artistInstance->current_user;?>.png" id="user-icon" class="user-icon" /> <?php echo $artistInstance->current_user_name;?> <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="settings/">Settings</a></li>
                        <li><a href="logout/">Log Out</a></li>
                      </ul>
                    </li>
                  </ul>
                  <?php /*<form class="navbar-form navbar-right" action="search/">
                    <div class="form-group">
                      <input type="text" class="typeahead form-control" placeholder="Search Artists & Posts">
                    </div>
                    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                  </form>*/ ?>
                  
                </div>
              </div>
            </nav>
            
        </header>
        
        <script type="text/javascript">
      	$('input.typeahead').typeahead({
      	    source:  function (query, process) {
              return $.get('var/cache/summits.cache', { query: query }, function (data) {
              		console.log(data);
              		data = $.parseJSON(data);
      	            return process(data);
      	        });
      	    },
      	    updater: function (item) {
                window.location.href = 'summit/'+item.summit_id+'/';
                return item;
            }
      	});
      </script>
      <?php } ?>