<?php
$conn = new Mongo("mongodb://gists:Gist!909All@db.gistai.com:30001");
$db = $conn->Gistglobal;
$groupwidgets = $db->Widgets;
$wid=$_POST['wid'];
$cursorwidgets = $groupwidgets->find(array('LinkedPublishers' => array('$in'=> array($wid))));
$groupwidgetArray = array();
foreach ($cursorwidgets as $var) {
	$groupwidgetArray[$var['Name']] = $var['old_id'];
}
// return json$groupwidgetArray;
header("Content-type:application/json"); 
echo json_encode($groupwidgetArray);
?>