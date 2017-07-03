<?php

if (isset($_POST) && count($_POST)>0 &&	empty($_POST['ip']) == false &&	empty($_POST['port']) == false)
{
	echo $_POST['ip'].":".$_POST['port'];
	sleep(1);
	exit;
}

?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
		$( document ).ready(function() {

			disen = function(s){ // disable, enable
				$(s).prop('disabled', function(i, v) { return !v; });
				console.log('disable/enable button');
			};

			$( "#b1" ).on( "click", function() {

        console.log('button click');
				disen(this);

	var ajx = $.ajax({
					url: "select_query_for_AJAX.php",
					method: "POST",
					data: { ip : "127.0.0.1", port : "80" },
					dataType: "text",
					success: function(data) {alert(data);
						
						$('#info').html(data);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						$('#info').html(textStatus + ", " + errorThrown);
					},
					complete: function() {
						disen("#b1");
					},
				});
			});
		});
	</script>
</head>
<body>

<span id="info"></span><br>

<input type="button" id="b1" value="test">

</body>
</html>