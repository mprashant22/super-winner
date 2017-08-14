"<?php
$mycustom = $shopify('GET /admin/themes/145783113/assets.json?asset[key]=layout/theme.liquid&theme_id=145783113');
$me = $mycustom['value'];

?>"
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>	
	$(document).ready(function(){	
	var current_theme =  "<?php echo $me; ?>"; //possibly from the get asset var. 
    var new_theme = jQuery(current_theme).find('body').append('<h1>Hello</h1>');
	//console.log(new_theme);	
})
	</script>

"<?php //////// code /////////?>"