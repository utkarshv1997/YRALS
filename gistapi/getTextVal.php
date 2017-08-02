<?php
$conn = new Mongo("mongodb://gists:Gist!909All@db.gistai.com:30001");
$db = $conn->Gistglobal;
$id = $_POST['id'];
$grouptext1 = $db->Text1;
$cursortext1 = $grouptext1->find(array('Id' => $id));

$db1 = $conn->Gistglobal;
$oid = $_POST['oid'];
$groupwidgets = $db1->Widgets;
$cursorwidgets = $groupwidgets->find(array('old_id' => $oid));

$db1 = $conn->Gistglobal;
$pid = $_POST['pid'];
$grouplogo = $db1->Logo;
$cursorlogos = $grouplogo->find(array('LinkedPublishers' => array('$in' => array($pid))));

$grouptext1Array = array();
foreach($cursortext1 as $itr){
	$grouptext1Array['MaxLine']=$itr['MaxLine'];
	$grouptext1Array['CanvasSize']=$itr['CanvasSize'];
	$grouptext1Array['TextColor']=$itr['TextColor'];	 
	$grouptext1Array['TextXAxis']=$itr['TextXAxis'];
	$grouptext1Array['StrokeVisible']=$itr['StrokeVisible'];
	$grouptext1Array['StrokeWidth']=$itr['StrokeWidth'];
	$grouptext1Array['HLShadowXAxis']=$itr['HLShadowXAxis'];
	$grouptext1Array['HLShadowYAxis']=$itr['HLShadowYAxis'];
	$grouptext1Array['HLShadowColor']=$itr['HLShadowColor'];
	$grouptext1Array['HLFontName']=$itr['HLFontName'];
	$grouptext1Array['TypeCase']=$itr['TypeCase'];
	$grouptext1Array['TextBackgroundOption']=$itr['TextBackgroundOption'];
	$grouptext1Array['ShadowYAxis']=$itr['ShadowYAxis'];
	$grouptext1Array['StrokeColor']=$itr['StrokeColor'];
	$grouptext1Array['TextAlign']=$itr['TextAlign'];
	$grouptext1Array['HLFontFile']=$itr['HLFontFile'];
	$grouptext1Array['FontSize']=$itr['FontSize'];
	$grouptext1Array['ShadowColor']=$itr['ShadowColor'];
	$grouptext1Array['HLStrokeColor']=$itr['HLStrokeColor'];
	$grouptext1Array['FontFile']=$itr['FontFile'];
	$grouptext1Array['ShadowVisible']=$itr['ShadowVisible'];
	$grouptext1Array['HLShadowBlur']=$itr['HLShadowBlur'];
	$grouptext1Array['Background']=$itr['Background'];
	$grouptext1Array['TextBackgroundType']=$itr['TextBackgroundType'];
	$grouptext1Array['HLFontSize']=$itr['HLFontSize'];
	$grouptext1Array['TextBackgroundVisible']=$itr['TextBackgroundVisible'];
	$grouptext1Array['TextPadding']=$itr['TextPadding'];
	$grouptext1Array['HLStrokeWidth']=$itr['HLStrokeWidth'];
	$grouptext1Array['TextBackground']=$itr['TextBackground'];
	$grouptext1Array['LineSpacing']=$itr['LineSpacing'];
	$grouptext1Array['ShadowBlur']=$itr['ShadowBlur'];
	$grouptext1Array['BackgroundVisible']=$itr['BackgroundVisible'];
	$grouptext1Array['HLTextColor']=$itr['HLTextColor'];
	$grouptext1Array['Type']=$itr['Type'];
	$grouptext1Array['BackgroundType']=$itr['BackgroundType'];
	$grouptext1Array['TextYAxis']=$itr['TextYAxis'];
	$grouptext1Array['HLStrokeVisible']=$itr['HLStrokeVisible'];
	$grouptext1Array['HLShadowVisible']=$itr['HLShadowVisible'];
}

foreach($cursorwidgets as $itr){
	$grouptext1Array['TextPosition']=$itr['TextPosition'];
	$grouptext1Array['SourcePosition']=$itr['SourcePosition'];
	$grouptext1Array['TItlePosition']=$itr['TItlePosition'];
	// $grouptext1Array['LogoPosition']=$itr['LogoPosition'];
	$grouptext1Array['Position']=$itr['Position'];
	$path=$itr['Path'].$itr['Color']."2.png";
	$grouptext1Array['astonpath']=$path;
}

foreach ($cursorlogosrs as $itr) {
	$grouptext1Array['logopath']=$itr['S3Url'];
	$grouptext1Array['LogoPosition']=$itr['Position'];
}

header("Content-type:application/json"); 
echo json_encode($grouptext1Array);
?>