<?php

$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    echo $request;
    //@$x = $request->email;    
    //echo $x; //this will go back u
    
    ?>