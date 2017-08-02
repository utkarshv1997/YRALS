<?php
$conn = new Mongo("mongodb://gists:Gist!909All@db.gistai.com:30001");
$db = $conn->Gistglobal;
// $oidstr=$_POST['oid'];
$oidstr='6072170c48e53d1124706cd8572f371c,17b7d90f11098fb3a31f5dddeaebd07c';
// $webid=$_POST['wid'];
$webid='76008b6b08f395fb83063134030264f9_data';
$oidarr=explode(',', $oidstr);
print_r($oidarr);	
?>