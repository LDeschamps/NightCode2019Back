<?php
$myObj=new StdClass();
$myObj->status="Ok";
$myJSON = json_encode($myObj);

echo $myJSON;
?>
