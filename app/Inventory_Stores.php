<form id="tbl">
<input type="text" name="name">
<button id="btn">submit</button>
</form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript">
$(document).ready(function(){

$("#btn").click(function(){

 var myform = document.getElementById("tbl");
  var fd = new FormData(myform );
  $.ajax({
     url: "Inventory_Stores.php",
      data: fd,
      cache: false,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function (dataofconfirm) {
    	  alert(dataofconfirm);
          $("#demo").text("jkdhilahg");
         
      }
  });
});

});

</script>

<div id="demo">
  ranjeet
</div>

<?php 
if(!empty($_POST['name']))
{
	echo 'empty';	
}
else {
	echo 'empty';
}

?>