 <?php
$conn = new Mongo("mongodb://gists:Gist!909All@db.gistai.com:30001");
$db = $conn->GistButton;
$grouppub = $db->gist_publishers;
$groupweb = $db->gist_websites;
$cursorpub = $grouppub->find(array("status"=>"active","pub"=>"yes"));
$groupArray = array();    // Array key=shortName value=web_id
foreach($cursorpub as $a){
    $x=$a['publisher_id'];
	$cursorweb = $groupweb->find(array("publisher_id"=>$x));
	foreach ($cursorweb as $b) {
		$groupArray[$a['shortName']]=$b['web_id']."_data";
	}
}
// print_r($groupArray);
$groupwidgets = $db->Widgets;
$cursorwidgets = $groupwidgets->find();
$arraywidgets = iterator_to_array($cursorwidgets));
$wid="62185c53aeef2effc48672bf09f513ee_1_data";
$groupwidgetArray = array();
foreach ($arraywidgets as $var) {
	$lp = $var['LinkedPublishers'];
	foreach ($lp as $val) {
		if($val==$wid){
			$groupwidgetArray[$lp['Name']] = $lp['old_id'];
		}
	}
}
// print_r($grouptextArray);
$oid="60df9490cc79631e25ecf688232e5db6iqhben";
$grouptext1 = $db->text1;
$cursortext1 = $grouptext1->find(array("old_id"=>$oid));
$grouptext1Array = array();
foreach ($cursortext1 as $itr) {
	$grouptext1Array[$itr['Name']] = $itr['id']; 
}
?> 