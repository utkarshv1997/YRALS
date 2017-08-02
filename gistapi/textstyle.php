<?php
$conn = new Mongo("mongodb://gists:Gist!909All@db.gistai.com:30001");
$db = $conn->Gistglobal;
$oidarr=$_POST['oids'];
$webid=$_POST['wid'];
$grouptext1 = $db->Text1;
$cursortext1 = $grouptext1->find(array('$and' => array(array('LinkedPublishers' => array('$in'=> array($webid))),array('old_id' => array('$in' => $oidarr)))));
$grouptext1Array = array();
foreach ($cursortext1 as $itr) {
	$grouptext1Array[$itr['Name']] = $itr['Id']; 
}
header("Content-type:application/json"); 
echo json_encode($grouptext1Array);
?>