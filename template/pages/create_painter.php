<?php
define('_mode','create_painter');
define('_page_title','Do a drawing of your very own');

require_once('template/header.php');
?>

    <div id="create-container">
        
        
        <div id="chickenpaint-parent"></div>
        
        <script>
            new ChickenPaint({
                uiElem: document.getElementById("chickenpaint-parent"),
                saveUrl: "ajax/create_painter_post.php",
                postUrl: "create-painter-post/",
                exitUrl: "/",
                resourcesRoot: "includes/chickenpaint/resources/"
            });
        </script>
        
        <?php /*<div id="painter-parent">
            <div id="painter">
    			<script type="text/javascript">
		           Ritare.start({
    					parentel: "painter",
    					onFinish: function(e) {
    					    $base64=Ritare.canvas.toDataURL('image/png');
    					    $base64.replace('data:image/png;base64,','');
    					    $postVals={'base64':$base64}
    					    $.post('ajax/create_painter_add.php',$postVals);
    						$('#painter').hide();
    						$('#painter-parent').remove();
    						$('#create-container').append('<div class="alert alert-success">Thing posted</div>');
    					},
    					width:800,
    					height:550
    				});
    				
    				$("#picker").spectrum({
                        color: "#000",
                        flat: 'true',
                        showInput: false,
                        showButtons: false,
                        change: function(color) {
                            Ritare.color=color.toHexString();
                            Ritare.colors=color.toRgb();
                            Ritare.colors[0]=Ritare.colors['r'];
                            Ritare.colors[1]=Ritare.colors['g'];
                            Ritare.colors[2]=Ritare.colors['b'];
                        },
                        move: function(color) {
                            Ritare.color=color.toHexString();
                            Ritare.colors=color.toRgb();
                            Ritare.colors[0]=Ritare.colors['r'];
                            Ritare.colors[1]=Ritare.colors['g'];
                            Ritare.colors[2]=Ritare.colors['b'];
                        }
                    });
    			</script>
    		</div>
    		*/?>
    	</div>

<?php
require_once('template/footer.php');