<?php
$conn = new Mongo("mongodb://gists:Gist!909All@db.gistai.com:30001");
$db = $conn->GistButton;
$grouppub = $db->gist_publishers;
$groupweb = $db->gist_websites;
$cursorpub = $grouppub->find(array("status"=>"active","pub"=>"yes")); // populate the publisher names
$groupArray = array();    // Array key=shortName value=web_id
foreach($cursorpub as $a){
    $x=$a['publisher_id'];
    $cursorweb = $groupweb->find(array("publisher_id"=>$x));
    foreach ($cursorweb as $b) {
        $groupArray[$a['shortName']]=$b['web_id']."_data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>VIEWS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link type="text/javascript" src="js/jquery-ui/jquery-ui.min.css"/>
  <script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/toastr.min.css"/>
  <script type="text/javascript" src="js/toastr.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css"/>
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
  <style type="text/css">
  	
  	/*.ui-wrapper{
  		min-height: 406px;
  		min-width: 720px;
  	}*/

  </style>
</head>
<body style="color: #337ab7">

<div class="container-fluid">
  <h2>GET IMAGE</h2>
  <p style="color: grey;">Click on tabs to set specific options for the image,text and background</p>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">General</a></li>
    <li><a data-toggle="tab" href="#menu1">BackGround</a></li>
    <li><a data-toggle="tab" href="#menu2">Text</a></li>
    <li><a data-toggle="tab" href="#menu3">Highlight</a></li>
    <li><a data-toggle="tab" href="#menu4">Locations</a></li>
  </ul>

  <div class="tab-content col-md-4" style="border-bottom: 1px solid grey;border-right: 1px solid grey;border-left: 1px solid grey;">
    <div id="home" class="tab-pane fade in active">
        <form class="form-compact" role="form">
        <br>
        <div class="form-group row">
            <div class="col-md-4">
              <label for="textType">Text Type</label>
              <select id="text_type" class="form-control"> 
                    <option value="StoryName" disabled="disabled">Story Name</option>
                    <option value="Header" disabled="disabled">Header</option>
                    <option value="Text" selected>Text</option>
                    <option value="Source" disabled="disabled">Source</option>
                    <option value="Credits" disabled="disabled">Credits</option>
              </select>
            </div>
            <div class="col-md-4">
                <label for="textName">Text Name</label>
                <input type="text" name="textname" id="text_name" class="form-control" value="text">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
              <label for="typeCase">Type Case</label>
              <select id="text_case" class="form-control"> 
                    <option value="1" selected>custom</option>
                    <option value="2">lower</option>
                    <option value="3">upper</option>
                    <option value="4">title</option>
              </select>
            </div>
            <div class="col-md-4">
                <label for="aspectRatio">Aspect Ratio</label>
                <select id="aspect_ratio" class="form-control">
                    <option value="16:9" selected>16:9</option>
                    <option value="9:16">9:16</option>
                    <option value="4:3">4:3</option>
                    <option value="3:4">3:4</option>
                    <option value="1:1">1:1</option> 
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="Resolution">Resolution</label>
                <select id="res" class="form-control">
                    <option value="1" selected>SD</option>
                    <option value="2">HD</option>
                    <option value="3">SHD</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="aston">Select Aston</label>
                <select id="astonband" class="form-control">
                    <option value="1" selected>Yellow2</option>
                    <option value="2">L-Rect Small</option>
                    <option value="3">Paper</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="width">Canvas Width(%)</label>
                   <input type="number" id="canvas_size_width" step="1" value="60" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="height">Canvas Height(%)</label>
                   <input type="number" id="canvas_size_height" step="1" value="25" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="textAlign">Text Align</label>
                <select name="text_align" id="text_align" class="form-control">
                    <option selected>left</option> 
                    <option>right</option>
                    <option>center</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="padding">Padding(%)</label>
                <input id="text_padding" type="number" name="text_padding" step="0.1" value="0.0" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                <label for="maxlines">Max Lines</label>
                 <input id="max_line" type="number" name="max_line" step="1" value="2" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="gap">Space Between two lines(px)</label>
                <input id="get_between_lines" type="number" name="between_two_lines" step="1" value="0" class="form-control">
            </div>
        </div>
        </form>
    </div>
    <div id="menu1" class="tab-pane fade">
        <form class="form-compact" role="form">
        <br>
            <div class="form-group row">
                <div class="col-md-6">
                  <label for="BGyn">Enable Canvas Background?</label>
                  <br>
                    <label><input type="radio" name="radio" onclick="handleClick1(this)" value="yes" >Yes</label>
                    <label><input type="radio" name="radio" onclick="handleClick2(this)" value="no" checked>No</label>
                </div>
            </div>
            <div class="form-group row">    
                <div class="col-md-4" id="bgtype" style="display: none;">
                    <label for="BackgroundCase">BackGround Type</label>
                    <select id="bgselect" name="bgtype" onclick="handleClick3(this)" class="form-control">
                        <option value="color" selected>color</option> 
                        <option value="image">image</option>
                        <option value="video">video</option>
                    </select>
                </div>
                <div class="col-md-4" id="vurl" style="display: none;">
                    <label for="videoURL">Video Url</label>
                    <input type="url" name="bgvideo" id="video" class="form-control">
                </div>
                <div class="col-md-4" id="iurl" style="display: none;">
                    <label for="imageURL">Image Url</label>
                    <input type="url" name="bgvideo" id="image" class="form-control">
                </div>
                <div class="col-md-4" id="col" style="display: none;">
                    <label for="videoURL">Color(RGBA)</label>
                    <input id="color" type="color" name="favcolor" value="#3355cc" class="form-control">
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="form-group row">
                <div class="col-md-6">
                  <label for="textBGyn">Enable Text Background?</label>
                  <br>
                    <label><input type="radio" name="tradio" onclick="handleClickt1(this)" value="yes" >Yes</label>
                    <label><input type="radio" name="tradio" onclick="handleClickt2(this)" value="no" checked>No</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4" id="tbgtype" style="display: none;">
                    <label for="BackgroundCase">BackGround Type</label>
                    <select id="tbgselect" name="tbgtype" onclick="handleClickt3(this)" class="form-control">
                        <option value="color" selected>color</option> 
                        <option value="image">image</option>
                        <option value="video">video</option>
                    </select>
                </div>
                <div class="col-md-4" id="tvurl" style="display: none;">
                    <label for="tvideoURL">Video Url</label>
                    <input type="url" name="tbgvideo" id="tvideo" class="form-control">
                </div>
                <div class="col-md-4" id="tiurl" style="display: none;">
                    <label for="timageURL">Image Url</label>
                    <input type="url" name="tbgvideo" id="timage" class="form-control">
                </div>
                <div class="col-md-4" id="tcol" style="display: none;">
                    <label for="tvideoURL">Color(RGBA)</label>
                    <input id="tcolor" type="color" name="tfavcolor" value="#3355cc" class="form-control">
                </div>
            </div>
        </form>
    </div>
    <div id="menu2" class="tab-pane fade">
        <form class="form-compact" role="form">
            <br>
            <div class="form-group row">  
            <div class="col-md-8">
              <label for="textshow">Enter Text</label>
              <textarea id="text_val" class="form-control" rows="5" placeholder="Enter Text Here..." required></textarea>
            </div>
            </div>
            <div class="form-group row">
            <div class="col-md-3">
                <label for="fontSize">Font Size</label>
                <input id="font_size" type="number" name="font_size" value="20" step="1" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="font type">Font Type</label>
                <select id="drop_family" class="form-control"> 
                <option selected="" value="Roboto" hidden>Roboto</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="font style">Font Style</label>
                <select id="drop_style" class="form-control">
                <option selected value="300" hidden>Thin</option> 
                </select>
            </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4" id="tcol">
                    <label for="textColor">Text Color(RGBA)</label>
                    <input id="txcolor" type="color" name="txfavcolor" value="#ffffff" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                  <label for="stryn">Enable Text Stroke?</label>
                  <br>
                    <label><input type="radio" name="radiostr" onclick="handleClickstr1(this)" value="yes">Yes</label>
                    <label><input type="radio" name="radiostr" onclick="handleClickstr2(this)" value="no" checked>No</label>
                </div>
                <div class="col-md-3" style="display: none;" id="sw">
                    <label for="strokeWidth">Stroke Width</label>
                    <input id="str_width" type="number" name="strokewidth" step="0.1" value="0.0" class="form-control">
                </div>
                <div class="col-md-4" style="display: none;" id="sc">
                    <label for="strokeColor">Stroke Color(RGBA)</label>
                    <input id="strcolor" type="color" name="strfavcolor" value="#000000" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                  <label for="stryn">Enable Text Shadow?</label>
                  <br>
                    <label><input type="radio" name="radiosh" onclick="handleClicksh1(this)" value="yes" >Yes</label>
                    <label><input type="radio" name="radiosh" onclick="handleClicksh2(this)" value="no" checked>No</label>
                </div>
                <div class="col-md-4" style="display: none;" id="shc">
                    <label for="shadowColor">Shadow Color(RGBA)</label>
                    <input id="shcolor" type="color" name="shfavcolor" value="#000000" class="form-control">
                </div>
            </div>
            <div class="form-group row" style="display: none;" id="sx">
                <div class="col-md-3">
                    <label for="shX">Shadow X-coordinate(px)</label>
                    <input id="shx" type="number" name="ShadowX" step="1" value="0" class="form-control">
                </div>
                <div class="col-md-3" style="display: none;" id="sy">
                    <label for="shY">Shadow Y-coordinate(px)</label>
                    <input id="shy" type="number" name="ShadowY" step="1" value="0" class="form-control">
                </div>
                <div class="col-md-3" style="display: none;" id="sb">
                    <label for="shBlur">Shadow Blur</label>
                    <input id="shBlur" type="number" name="ShadowBlur" step="1" value="0" class="form-control">
                </div>
            </div>
        </form>
    </div>
    <div id="menu3" class="tab-pane fade">
        <form class="form-compact" role="form">
            <br>
            <div class="form-group row">  
            <div class="col-md-8">
              <label for="HLtextshow">Enter Text To Be Highlighted</label>
              <textarea id="HLtext_val" class="form-control" rows="5" placeholder="Enter Text Here..."></textarea>
            </div>
            </div>
            <div class="form-group row">  
            <div class="col-md-3">
                <label for="HLfontSize">Font Size</label>
                <input id="HLfont_size" type="number" name="font_size" value="20" step="1" class="form-control">
            </div>
            <div class="col-md-3">
                <label for="HLfont type">Font Type</label>
                <select id="HLdrop_family" class="form-control"> 
                <option selected value="Roboto" hidden>Roboto</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="HLfont style">Font Style</label>
                <select id="HLdrop_style" class="form-control">
                <option selected value="300" hidden>Thin</option> 
                </select>
            </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4" id="tcol">
                    <label for="HLtextColor">Highlighted Text Color(RGBA)</label>
                    <input id="HLtxcolor" type="color" name="HLtxfavcolor" value="#000000" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                  <label for="HLstryn">Enable HighLighted Text Stroke?</label>
                  <br>
                    <label><input type="radio" name="radio" onclick="handleClickstr1HL(this)" value="yes" >Yes</label>
                    <label><input type="radio" name="radio" onclick="handleClickstr2HL(this)" value="no" checked>No</label>
                </div>
                <div class="col-md-4" id="HLsw" style="display: none;">
                    <label for="HLstrokeWidth">Stroke Width</label>
                    <input id="HLstroke_width" type="number" name="HLstrokewidth" step="0.1" value="0.0" class="form-control">
                </div>
                <div class="col-md-4" id="HLsc" style="display: none;">
                    <label for="HLstrokeColor" id="HLsc">Highlighted Stroke Color(RGBA)</label>
                    <input id="HLstrcolor" type="color" name="HLstrfavcolor" value="#000000" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                  <label for="HLstryn">Enable Highlighted Text Shadow?</label>
                  <br>
                    <label><input type="radio" name="HLradiosh" onclick="handleClicksh1HL(this)" value="yes" >Yes</label>
                    <label><input type="radio" name="HLradiosh" onclick="handleClicksh2HL(this)" value="no" checked>No</label>
                </div>
                <div class="col-md-4" id="HLshc" style="display: none;">
                    <label for="HL">Shadow Color(RGBA)</label>
                    <input id="HLshcolor" type="color" name="HLshfavcolor" value="#000000" class="form-control">
                </div>
            </div>
            <div class="form-group row" id="HLsx" style="display: none;">
                <div class="col-md-4">
                    <label for="HLshX">Shadow X-coordinate(px)</label>
                    <input id="HLshx" type="number" name="HLShadowX" step="1" value="0" class="form-control">
                </div>
                <div class="col-md-4" style="display: none;" id="HLsy">
                    <label for="HLshY">Shadow Y-coordinate(px)</label>
                    <input id="HLshy" type="number" name="HLShadowY" step="1" value="0" class="form-control">
                </div>
                <div class="col-md-4" id="HLsb" style="display: none;">
                    <label for="HLshBlur">Shadow Blur</label>
                    <input id="HLshblur" type="number" name="HLShadowBlur" step="1" value="0" class="form-control">
                </div>
            </div>
        </form>
    </div>
    <div id="menu4" class="tab-pane fade">
        <br>
        <form>
            <div class="form-group row">
                <div class="col-md-4" id="x-cd">
                    <label for="xcd">X-Coordinate(px)</label>
                    <input id="tx" type="text" name="t-x" step="1" value="0" class="form-control">
                </div>
                <div class="col-md-4" id="y-cd">
                    <label for="ycd">Y-Coordinate(px)</label>
                    <input id="ty" type="text" name="t-y" step="1" value="0" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4" id="lx-cd">
                    <label for="xcd">Logo X-Coordinate(px)</label>
                    <input id="ltx" type="text" name="lt-x" step="1" value="0" class="form-control" onchange="drawlogo()">
                </div>
                <div class="col-md-4" id="ly-cd">
                    <label for="ycd">Logo Y-Coordinate(px)</label>
                    <input id="lty" type="text" name="lt-y" step="1" value="0" class="form-control" onchange="drawlogo()">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4" id="sx-cd">
                    <label for="xcd">Source X-Coordinate(px)</label>
                    <input id="stx" type="text" name="st-x" step="1" value="0" class="form-control" onchange="drawsrc()">
                </div>
                <div class="col-md-4" id="sy-cd">
                    <label for="ycd">Source Y-Coordinate(px)</label>
                    <input id="sty" type="text" name="st-y" step="1" value="0" class="form-control" onchange="drawsrc()">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4" id="tx-cd">
                    <label for="xcd">Title X-Coordinate(px)</label>
                    <input id="ttx" type="text" name="tt-x" step="1" value="0" class="form-control" onchange="drawtitle()">
                </div>
                <div class="col-md-4" id="ty-cd">
                    <label for="ycd">Title Y-Coordinate(px)</label>
                    <input id="tty" type="text" name="tt-y" step="1" value="0" class="form-control" onchange="drawtitle()">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4" id="ax-cd">
                    <label for="xcd">Aston X-Coordinate(px)</label>
                    <input id="atx" type="text" name="at-x" step="1" value="0" class="form-control" onchange="drawaston()">
                </div>
                <div class="col-md-4" id="ay-cd">
                    <label for="ycd">Aston Y-Coordinate(px)</label>
                    <input id="aty" type="text" name="at-y" step="1" value="0" class="form-control" onchange="drawaston()">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6" id="border-select">
                    <label for="border">Enable Text Border?</label>
                    <label class=""><input type="radio" name="radio1" onclick="setBorder(this)" value="yes" checked>Yes</label>
                    <label class=""><input type="radio" name="radio1" onclick="resetBorder(this)" value="no">No</label>
                </div>
            </div>
            <div class="form-group row" style="margin-left: 1%">
                <label for="logoimg">Upload Logo</label>
                <input type="file" name="logofile" id="logoimg">
            	<label for="logoimg">Upload Source</label>
                <input type="file" name="sourcefile" id="sourceimg">
                <label for="logoimg">Upload Title</label>
                <input type="file" name="titlefile" id="titleimg">
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Publisher</label>
                    <select id="publishers" name="pubshort" class="form-control" onchange="loadWidget(this.value)"> 
                    <option hidden selected disabled>Select Publisher</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Widget</label>
                    <select id="widget" name="widgets" class="form-control" onchange="loadText(this.value)"> 
                    <option hidden selected disabled>Select Widget</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label><input type="radio" name="radiotext" onclick="setText(this)" value="text" checked>Text</label>
                    <label><input type="radio" name="radiotext" onclick="setWText(this)" value="wtext" >Widget Text</label>
                </div>
                <div class="col-md-6">
                    <label>Text Style</label>
                    <select id="textstyle" name="TextStyle" class="form-control" onchange="getValues()"> 
                    <option hidden selected disabled>Select Text</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
  </div>
  <div class="col-md-7">
	      <div id="img_canvas" style="z-index: 1;height:406px; width:720px;position: absolute;background-image: url('images/img_test2.jpg')">
	          <img id="logo" src="" style="z-index: 6;position: absolute;width: 25%;height: 15%;">
	          <img id="source" style="z-index: 6;position: absolute;width: 20%;height: 5%;">
	          <img id="title" style="z-index: 6;position: absolute;width: 35%;height: 25%;">
	          <img id="gif1" style="z-index: 5;width: 587px; height: 109px;" src="https://lh3.googleusercontent.com/-IiBrIl2fvp8/WUFHgIMJ0VI/AAAAAAAAGdA/Tt-Cm4EOyhYQ2QFPgCrsaSez5tS4rUqiACL0BGAYYCw/h193/2017-06-14.png">
	          <img id="image1" style="z-index: 10;border: 2px solid #000; position:absolute;" src="">
	      	  <button style="margin-top: 50%;position: relative; margin-left: 40%;" type="button" class="btn btn-primary btn-lg" id="sub">Submit</button>
	      	  
	      </div>
  </div>
</div>
</body>

<script type="text/javascript">

				function getTextValues(idinput,oidinput,pubid){    // get the value of attributes to be filled in all the fields
                    console.log('get text val..');
                    console.log(idinput+' , '+oidinput+' , '+pubid);
					$.ajax({
						url: 'getTextVal.php',
						data: {'id':idinput,'oid':oidinput,'pid':pubid},
						datatype: 'json',
						type: 'post',
						success: function(output){
							
						},
						error: function(output){
							console.log("Can't get the values from database!, "+output);
						}
					});
				}

                function getValues(){						// get Values of the textID, oldid, pubid currently filled in

                    var textId=$('#textstyle').val();
                    var oldid=$('#widget').val();
                    var pubid=$("#publishers").val();
                    getTextValues(textId,oldid,pubid);
                }

                function setText(){								// on change of radio button to select between text and widget text
                    var selText= $("#textstyle");
                        $("#textstyle > option").each(function() {
                            if((this.text).indexOf('WidgetText')!=-1){
                                $(this).attr('hidden','hidden');
                            } 
                            else{
                                $(this).removeAttr('hidden');
                            }
                        });
                }

                function setWText(){						// on change of radio button to get widget text as text styles
                     var selText= $("#textstyle");
                     $("#textstyle > option").each(function() {
                            if((this.text).indexOf('WidgetText')==-1){
                                $(this).attr('hidden','hidden');
                            } 
                            else{
                                $(this).removeAttr('hidden');
                            }
                        });
                }

                function loadText(input){						//  load the values of text styles
                    console.log('load text..');
                    $("#textstyle").empty();
                    var inputarr=input.split(",");
                    var webid=$('#publishers').val();
                    $.ajax({ 
                        url: 'textstyle.php',
                        data: {'oids': inputarr,'wid': webid},
                        type: 'post',
                        datatype: 'json',
                        success: function(output) {
                            $.each(output,function(key,value){
                                $("#textstyle").append($('<option></option>').val(value).html(key));
                            });
                            var radiotextval=$('input[name="radiotext"]:checked').val();
                            if(radiotextval=="text"){
                            	setText();
                            }
                            else{
                            	setWText();
                            }
                            var textId=$('#textstyle').val();
                            var oldid=$('#widget').val();
                            var pubid=$("#publishers").val();
                            getTextValues(textId,oldid,pubid);
                        },
                        error: function(output){
                            console.log(output+" Error Occured!\n");
                        }
                    });
                }

                function loadWidget(input){				// load the widget values
                    console.log('widget...');
                    $("#widget").empty();
                    $.ajax({ 
                        url: 'widget.php',
                        data: {'wid': input},
                        type: 'post',
                        datatype: 'json',
                        success: function(output) {
                            $.each(output,function(key,value){
                                $("#widget").append($('<option></option>').val(value).html(key));
                            });
                        },
                        error: function(output){
                            console.log(output+" Error Occured!\n");
                        }
                    });
                }

				var can_width;
                var can_height;
                var SD,HD,SHD;
                var ret=new Object();

				function save(file){  						// not called anywhere right now, made to calculate values if switched between SD, HD, SHD
					var r=document.getElementById("res");
                    var str2=r.options[r.selectedIndex].value;
                    file.xcd=$("#tx").val();
                    file.ycd=$("#ty").val();
                    file.lxcd=$("#ltx").val();
                    file.lycd=$("#lty").val();
                    file.sxcd=$("#stx").val();
                    file.sycd=$("#sty").val();
                    file.txcd=$("#ttx").val();
                    file.tycd=$("#tty").val();
                    ret=file;
                    switch(parseInt(str2)){
                    	case 1:
                    		break;
                    	case 2:
                    		ret.canvas_size_height=file.canvas_size_height*(HD/SD);
                    		ret.canvas_size_width=file.canvas_size_width*(HD/SD);
                    		ret.text_padding=file.text_padding*(HD/SD);
                    		ret.xcd=file.xcd*(HD/SD);
                    		ret.ycd=file.ycd*(HD/SD);
                    		ret.lxcd=file.lxcd*(HD/SD);
                    		ret.lycd=file.lycd*(HD/SD);
                    		ret.sxcd=file.sxcd*(HD/SD);
                    		ret.sycd=file.sycd*(HD/SD);
                    		ret.txcd=file.txcd*(HD/SD);
                    		ret.tycd=file.tycd*(HD/SD);
                    		break;
                    	case 3:
                    		ret.canvas_size_height=file.canvas_size_height*(SHD/SD);
                    		ret.canvas_size_width=file.canvas_size_width*(SHD/SD);
                    		ret.text_padding=file.text_padding*(SHD/SD);
                    		ret.xcd=file.xcd*(SHD/SD);
                    		ret.ycd=file.ycd*(SHD/SD);
                    		ret.lxcd=file.lxcd*(SHD/SD);
                    		ret.lycd=file.lycd*(SHD/SD);
                    		ret.sxcd=file.sxcd*(SHD/SD);
                    		ret.sycd=file.sycd*(SHD/SD);
                    		ret.txcd=file.txcd*(SHD/SD);
                    		ret.tycd=file.tycd*(SHD/SD);
                    		break;
                    }
				}

				function initialize(file){
					var ret=file;
				}
                

                document.getElementById('logoimg').onchange = function (evt) {		// used for loading logo
                    var tgt = evt.target || window.event.srcElement,
                        files = tgt.files;

                    if (FileReader && files && files.length) {
                        var fr = new FileReader();
                        fr.onload = function () {
                            document.getElementById('logo').src = fr.result;
                        }
                        fr.readAsDataURL(files[0]);
                    }
                    else {
                        console.log("Can't upload image");
                    }
                }

                document.getElementById('sourceimg').onchange = function (evt) {	// for loading source
                    var tgt = evt.target || window.event.srcElement,
                        files = tgt.files;

                    if (FileReader && files && files.length) {
                        var fr = new FileReader();
                        fr.onload = function () {
                            document.getElementById('source').src = fr.result;
                        }
                        fr.readAsDataURL(files[0]);
                    }
                    else {
                        console.log("Can't upload image");
                    }
                }

                document.getElementById('titleimg').onchange = function (evt) {					// for loading title
                    var tgt = evt.target || window.event.srcElement,
                        files = tgt.files;

                    if (FileReader && files && files.length) {
                        var fr = new FileReader();
                        fr.onload = function () {
                            document.getElementById('title').src = fr.result;
                        }
                        fr.readAsDataURL(files[0]);
                    }
                    else {
                        console.log("Can't upload image");
                    }
                }

                function init(){						// initialize the attributes to take a default value
                    handleClick2();
                    handleClickt2();
                    handleClicksh2();
                    handleClickstr2();
                    handleClickstr2HL();
                    handleClickstr2HL();
                }


                function hexToRgbA(hex){				 // hex to rgba converter
                    var c;
                    if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
                        c= hex.substring(1).split('');
                        if(c.length== 3){
                            c= [c[0], c[0], c[1], c[1], c[2], c[2]];
                        }
                        c= '0x'+c.join('');
                        var res=[(c>>16)&255, (c>>8)&255, c&255].join(',')+',1';
                        console.log(res);
                        return res;
                    }
                    throw new Error('Bad Hex');
                }

                function toast(){						// used to generate toast usinng toastr
                	toastr.options.timeOut=0;
                	toastr.options.extendedTimeout=0;
                	toastr.options.preventDuplicates="true";
                	toastr.error("OVERLAP DETECTED!");
                }

                function checkOverLap(){				// check overlap between source, title, logo and aston.

                    var e1=document.getElementById('logo');
                    var rect1=e1.getBoundingClientRect();
                    var e2=document.getElementById('source');
                    var rect2=e2.getBoundingClientRect();
                    var e3=document.getElementById('title');
                    var rect3=e3.getBoundingClientRect();
                    var e4=document.getElementById('gif1');
                    var rect4=e4.getBoundingClientRect();

                    var overlap1 = !(rect1.right < rect2.left || 
                    rect1.left > rect2.right || 
                    rect1.bottom < rect2.top || 
                    rect1.top > rect2.bottom);
                    var overlap2= !(rect1.right < rect3.left || 
                    rect1.left > rect3.right || 
                    rect1.bottom < rect3.top || 
                    rect1.top > rect3.bottom);
                    var overlap3= !(rect3.right < rect2.left || 
                    rect3.left > rect2.right || 
                    rect3.bottom < rect2.top || 
                    rect3.top > rect2.bottom);
                    var overlap4= !(rect1.right < rect4.left || 
                    rect1.left > rect4.right || 
                    rect1.bottom < rect4.top || 
                    rect1.top > rect4.bottom);
                    var overlap5= !(rect2.right < rect4.left || 
                    rect2.left > rect4.right || 
                    rect2.bottom < rect4.top || 
                    rect2.top > rect4.bottom);
                    var overlap6= !(rect3.right < rect4.left || 
                    rect3.left > rect4.right || 
                    rect3.bottom < rect4.top || 
                    rect3.top > rect4.bottom);

                    if(overlap1 || overlap2 || overlap3 || overlap4 || overlap5 || overlap6 ){
                        if(overlap1){
                            //alert('ov1');
                            document.getElementById("logo").style.opacity="0.2";
                            document.getElementById("source").style.opacity="0.2";
                            toast();
                            document.getElementById("sub").disabled = true;
                        }
                        if(overlap2){
                            document.getElementById("logo").style.opacity="0.2";
                            document.getElementById("title").style.opacity="0.2";
                            toast();
                            document.getElementById("sub").disabled = true;
                        }
                        if(overlap3){
                            document.getElementById("title").style.opacity="0.2";
                            document.getElementById("source").style.opacity="0.2";
                            toast();
                            document.getElementById("sub").disabled = true;
                        }
                        if(overlap4){
                            document.getElementById("logo").style.opacity="0.2";
                            document.getElementById("gif1").style.opacity="0.2";
                            toast();
                            document.getElementById("sub").disabled = true;
                        }
                        if(overlap5){
                            document.getElementById("source").style.opacity="0.2";
                            document.getElementById("gif1").style.opacity="0.2";
                            toast();
                            document.getElementById("sub").disabled = true;
                        }
                        if(overlap6){
                            document.getElementById("title").style.opacity="0.2";
                            document.getElementById("gif1").style.opacity="0.2";
                            toast();
                            document.getElementById("sub").disabled = true;
                        }
                        if(!(overlap1 || overlap2 || overlap4))
                            document.getElementById("logo").style.opacity="1";
                        if(!(overlap2 || overlap3 || overlap6))
                            document.getElementById("title").style.opacity="1";
                        if(!(overlap1 || overlap3 || overlap5))
                            document.getElementById("source").style.opacity="1";
                        if(!(overlap4 || overlap5 || overlap6))
                        	document.getElementById("gif1").style.opacity="1";
                           
                    }
                    else{
                        document.getElementById("logo").style.opacity="1";
                        document.getElementById("source").style.opacity="1";
                        document.getElementById("title").style.opacity="1";
                        document.getElementById("gif1").style.opacity="1";
                        document.getElementById("sub").disabled = false;
                        $("#stat").addClass("btn-success");
                        $("#stat").removeClass("btn-danger");
                    }
                }


                function drawlogo(){									// to draw logo if value in the attributes is changed
                            var img=document.getElementById('logo');
                            var x=$('#ltx').val();
                            var y=$('#lty').val();
                            //$("#logo").css("position","absolute");
                            $("#logo").css("top",y+"px");
                            $("#logo").css("left",x+"px");
                            checkOverLap();
                }

                function drawsrc(){							// to draw source if value in the attributes is changed

                            var img=document.getElementById('source');
                            var x=$('#stx').val();
                            var y=$('#sty').val();
                            //$("#source").css("position","absolute");
                            $("#source").css("top",y+"px");
                            $("#source").css("left",x+"px");
                            checkOverLap();
                }

                function drawtitle(){					// to draw title if value in the attributes is changed

                            var img=document.getElementById('title');
                            var x=$('#ttx').val();
                            var y=$('#tty').val();
                            //$("#title").css("position","absolute");
                            $("#title").css("top",y+"px");
                            $("#title").css("left",x+"px");
                            checkOverLap();
                }

                function drawaston(){					// to draw aston if value in the attributes is changed

                            var img=document.getElementById('gif1');
                            var x=$('#atx').val();
                            var y=$('#aty').val();
                            //$("#title").css("position","absolute");
                            $("#gif1").css("top",y+"px");
                            $("#gif1").css("left",x+"px");
                            checkOverLap();
                }

                function moveElements(){				// make logo, source, title, aston draggable
                        
                        var e=document.getElementById("gif1");
                        e.style.left="10%";
                        e.style.top="60%";
                		$("#gif1").draggable({
                                containment: "parent",
                                stop: function(event,ui){
                                    document.getElementById("atx").value=""+(ui.position.left);
                                    document.getElementById("aty").value=""+(ui.position.top);
                                    checkOverLap();
                                },
                                start: function(event,ui){
                                	toastr.clear();
                                }
                        });

                        $("#logo").draggable({
                                containment: "parent",
                                stop: function(event,ui){
                                    document.getElementById("ltx").value=""+(ui.position.left);
                                    document.getElementById("lty").value=""+(ui.position.top);
                                    checkOverLap();
                                },
                                start: function(event,ui){
                                	toastr.clear();
                                }
                        });

                        var e=document.getElementById('logo');
                        e.style.top = "2%";
                        e.style.right= "3%";
                        $("#source").draggable({
                                containment: "parent",
                                stop: function(event,ui){
                                    document.getElementById("stx").value=""+(ui.position.left);
                                    document.getElementById("sty").value=""+(ui.position.top);
                                    checkOverLap();
                                },
                                start: function(event,ui){
                                	toastr.clear();
                                }
                        });
                        
                        var s=document.getElementById('source');
                        s.style.top="2%";
                        s.style.left="2%";
                        $("#title").draggable({
                                containment: "parent",
                                stop: function(event,ui){
                                    document.getElementById("ttx").value=""+(ui.position.left);
                                    document.getElementById("tty").value=""+(ui.position.top);
                                    checkOverLap();
                                },
                                start: function(event,ui){
                                	toastr.clear();
                                }
                        });
                        var t=document.getElementById('title');
                        t.style.top="15%";
                        t.style.left="2%";

                }

                function findLarger(a,b){
                	if(a>b)
                		return a;
                	return b;
                }

                function onSelectRes(){								// on selection of resolution
                    var asp=document.getElementById("aspect_ratio");
                    var str1=asp.options[asp.selectedIndex].value;
                    var arr=str1.split(':');
                    // console.log(arr);
                    var mul_width=(parseInt(arr[0]))/(parseInt(arr[0])+parseInt(arr[1]));
                    // console.log(mul_width);
                    var mul_height=1-mul_width;
                    // console.log(mul_height);
                    
                    var greater=findLarger(mul_width,mul_height);
                    var inv=1/greater;
                    // console.log(inv);
                    if(mul_width==0.5){
                        SD=800*inv;
                        HD=1200*inv;
                        SHD=1800*inv;
                    }
                    else{
                        SD=720*inv;
                        HD=1280*inv;
                        SHD=1920*inv;
                    }
                    can_width=mul_width*SD;
                    can_height=mul_height*SD;
                }
                    

                var origin;
                var border_flag=1;
                function setBorder(){					// to set border for text
                    border_flag=1;
                    document.getElementById("tx").value=""+(origin.position.left+1);
                    document.getElementById("ty").value=""+(origin.position.top+1);
                    $("#image1").css('border','2px solid #000000');
                }

                function resetBorder(){				// to reset border
                    border_flag=0;
                    //document.getElementById("tx").value=""+(origin.position.left);
                    //document.getElementById("ty").value=""+(origin.position.top);
                    $("#image1").css('border','0px solid #000000');
                }

                var bgVal="";
                var tbgVal="";
                var strokeVal="";
                var shVal="";
                var HLstrokeVal="";
                var HLshVal="";
                function handleClick1(){		// to get value if bg is enabled
                    document.getElementById("bgtype").style.display="block";
                    bgVal='yes';
                }

                function handleClickt1(){		// to get value if text bg is enabled
                    document.getElementById("tbgtype").style.display="block";
                    tbgVal='yes';
                }

                function handleClickstr1(){		// to get value if stroke val is enabled
                    document.getElementById("sw").style.display="block";
                    document.getElementById("sc").style.display="block";
                    strokeVal='yes';
                }

                function handleClickstr1HL(){		// to get highlight stroke value
                    document.getElementById("HLsw").style.display="block";
                    document.getElementById("HLsc").style.display="block";
                    HLstrokeVal='yes';
                }

                function handleClicksh1(){			// to get shadow value
                    document.getElementById("shc").style.display="block";
                    document.getElementById("sx").style.display="block";
                    document.getElementById("sy").style.display="block";
                    document.getElementById("sb").style.display="block";
                    shVal='yes';
                }

                function handleClicksh1HL(){		// to get shadow highlight
                    document.getElementById("HLshc").style.display="block";
                    document.getElementById("HLsx").style.display="block";
                    document.getElementById("HLsy").style.display="block";
                    document.getElementById("HLsb").style.display="block";
                    HLshVal='yes';
                }

                function handleClickstr2(){			// to disable stroke 
                    document.getElementById("sw").style.display="none";
                    document.getElementById("sc").style.display="none";
                    strokeVal='no';
                }

                function handleClickstr2HL(){			// to disable stroke highlight
                    document.getElementById("HLsw").style.display="none";
                    document.getElementById("HLsc").style.display="none";
                    HLstrokeVal='no';
                }

                function handleClick2(){			// to disable bg 
                    document.getElementById("bgtype").style.display="none";
                    document.getElementById("vurl").style.display="none";
                    document.getElementById("iurl").style.display="none";
                    document.getElementById("col").style.display="none";
                    bgVal='no';
                }

                function handleClicksh2(){		// to disable shadow
                    document.getElementById("shc").style.display="none";
                    document.getElementById("sx").style.display="none";
                    document.getElementById("sy").style.display="none";
                    document.getElementById("sb").style.display="none";
                    shVal='no';
                }

                function handleClicksh2HL(){		// to disable highlight shadow
                    document.getElementById("HLshc").style.display="none";
                    document.getElementById("HLsx").style.display="none";
                    document.getElementById("HLsy").style.display="none";
                    document.getElementById("HLsb").style.display="none";
                    HLshVal='no';
                }

                function handleClickt2(){			// to disable text bg
                    document.getElementById("tbgtype").style.display="none";
                    document.getElementById("tvurl").style.display="none";
                    document.getElementById("tiurl").style.display="none";
                    document.getElementById("tcol").style.display="none";
                    tbgVal='no';
                }

                function handleClick3(){			// to select value of bg type
                    var e=document.getElementById("bgselect");
                    var str=e.options[e.selectedIndex].value;
                    if(str=='video'){
                        document.getElementById("vurl").style.display="block";
                        document.getElementById("iurl").style.display="none";
                        document.getElementById("col").style.display="none";
                    }
                    if(str=='image'){
                        document.getElementById("iurl").style.display="block";
                        document.getElementById("vurl").style.display="none";
                        document.getElementById("col").style.display="none";   
                    }
                    if(str=='color'){
                        document.getElementById("col").style.display="block";
                        document.getElementById("vurl").style.display="none";
                        document.getElementById("iurl").style.display="none";
                    }
                }

                function handleClickt3(){		// to select value of text bg type
                    var e=document.getElementById("tbgselect");
                    var str=e.options[e.selectedIndex].value;
                    if(str=='video'){
                        document.getElementById("tvurl").style.display="block";
                        document.getElementById("tiurl").style.display="none";
                        document.getElementById("tcol").style.display="none";
                    }
                    if(str=='image'){
                        document.getElementById("tiurl").style.display="block";
                        document.getElementById("tvurl").style.display="none";
                        document.getElementById("tcol").style.display="none";   
                    }
                    if(str=='color'){
                        document.getElementById("tcol").style.display="block";
                        document.getElementById("tvurl").style.display="none";
                        document.getElementById("tiurl").style.display="none";
                    }
                }

    $(document).ready(function () {


    		// $("#astonband").on('change',function(){
    		// 	var asp=document.getElementById("astonband");
      //           var str1=asp.options[asp.selectedIndex].value;
      //           switch(parseInt(str1)){
      //           	case 1:
      //           		$("#gif1").width(702).height(405);
      //           		document.getElementById("gif1").src="http://api3.gistai.com/Intro-Outro/aston/Roadies/yellow2.png";
      //           		break;
      //           	case 2:
      //           		$("#gif1").width(405).height(706);
      //           		document.getElementById("gif1").src="http://api3.gistai.com/Intro-Outro/astonband/nbt/LRect.png";
      //           		break;
      //           	case 3:
      //           		$("#gif1").width(800).height(800);
      //           		document.getElementById("gif1").src="http://api3.gistai.com/Intro-Outro/astonband/filmipop/paper.png";
      //           		break;
      //           	default:
      //           		break;
      //           }
      //           checkAston();
    		// });

           


            var pubarray=<?php echo json_encode($groupArray); ?>; // to get the value pub_id and pub short names

            function loadPub(){
                $.each(pubarray,function(key,value){
                    $("#publishers").append($('<option></option>').val(value).html(key));
                });
            }

            loadPub();


            function showFontsHL(items){			// to get fonts
                    $.each(items,function(i,p){
                        $("#HLdrop_family").append($('<option></option>').val(p.family).html(p.family));
                    });
            } 

            var fonts;
                            
            var fonturl="https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyBM4X4ueetanTCPdZ54yxuZm_SW2QUVuQE";
            $.ajax({
                'url': fonturl,
                'method': 'GET',
                'datatype': 'json',
                error: function(data){
                    console.log(data);
                },          
                success: function(data){
                    //console.log(data);
                    fonts=data;
                    showFontsHL(data.items);
                }
            });

            $("#HLdrop_family").on('change',function(){
                $('#HLdrop_style').empty();
                $.each(fonts.items,function(i,p){
                    if(this.family==$("#HLdrop_family").val()){
                        $.each(this.files,function(key,value1){
                            var value="";

                            switch(parseInt(key[0])){
                                case 1:
                                    value="Thin";
                                    break;
                                case 2:
                                    value="Extra Thin";
                                    break;
                                case 3:
                                    value="Light";
                                    break;
                                case 4:
                                    value="Normal";
                                    break;
                                case 5:
                                    value="Medium";
                                    break;
                                case 6:
                                    value="Semi Bold";
                                    break;
                                case 7:
                                    value="Bold";
                                    break;
                                case 8:
                                    value="Extra Bold";
                                    break;
                                case 9:
                                    value="Black";
                                    break;
                                default:
                                    value=key[0].toUpperCase()+key.substring(1);
                                    break;  
                             }
                             if(key.length!=3 && (parseInt(key[0])<=9)){
                                value = value+ " " +key.substring(3);
                             }
                            $("#HLdrop_style").append($('<option></option>').val(key).html(value));
                        }); 
                    }
                });
            });


            function showFonts(items){
                    $.each(items,function(i,p){
                        $("#drop_family").append($('<option></option>').val(p.family).html(p.family));
                    });
            } 

            var hlfonts;
                            
            var fonturl="https://www.googleapis.com/webfonts/v1/webfonts?sort=popularity&key=AIzaSyBM4X4ueetanTCPdZ54yxuZm_SW2QUVuQE";
            $.ajax({
                'url': fonturl,
                'method': 'GET',
                'datatype': 'json',
                error: function(data){
                    console.log(data);
                },          
                success: function(data){
                    //console.log(data);
                    fonts=data;
                    showFonts(data.items);
                }
            });

            $("#drop_family").on('change',function(){
                $('#drop_style').empty();
                $.each(fonts.items,function(i,p){
                    if(this.family==$("#drop_family").val()){
                        $.each(this.files,function(key,value1){
                            var value="";

                            switch(parseInt(key[0])){
                                case 1:
                                    value="Thin";
                                    break;
                                case 2:
                                    value="Extra Thin";
                                    break;
                                case 3:
                                    value="Light";
                                    break;
                                case 4:
                                    value="Normal";
                                    break;
                                case 5:
                                    value="Medium";
                                    break;
                                case 6:
                                    value="Semi Bold";
                                    break;
                                case 7:
                                    value="Bold";
                                    break;
                                case 8:
                                    value="Extra Bold";
                                    break;
                                case 9:
                                    value="Black";
                                    break;
                                default:
                                    value=key[0].toUpperCase()+key.substring(1);
                                    break;  
                             }
                             if(key.length!=3 && (parseInt(key[0])<=9)){
                                value = value+ " " +key.substring(3);
                             }
                            $("#drop_style").append($('<option></option>').val(key).html(value));
                        }); 
                    }
                });
            });

            moveElements();			// to make translatable the objects
            init();
            function onSelectCase(text){		// to change type case
                    //console.log(text);
                    var str=document.getElementById('text_case').options.selectedIndex;
                    switch(parseInt(str)){
                        case 0:
                            break;
                        case 1:
                            text=text.toLowerCase();
                            break;
                        case 2:
                            text=text.toUpperCase();
                            break;
                        case 3:
                            var retStr="";
                            var arr=text.split(" ");
                            for (var i = 0; i < arr.length; i++) {
                                arr[i]=arr[i][0].toUpperCase()+arr[i].substring(1);
                            }
                            for (var i = 0; i < arr.length; i++) {
                                retStr=retStr+arr[i]+" ";
                            }
                            text=retStr;
                            break;
                        default:
                            break;
                    }
                    
                    return text;    
            }

            function checkAston(){			// not being called anywhere, check for aston compatibility
            	var aston=document.getElementById("gif1");
            	var asp=document.getElementById("aspect_ratio");
                var str1=asp.options[asp.selectedIndex].value;
                var ast=document.getElementById("astonband");
                var str2=ast.options[ast.selectedIndex].value;
            	var flag=0;
            	switch(parseInt(str2)){
            		case 1:
            			if(str1!="16:9")
            				flag=1;
            			break;
            		case 2:
            			if(str1!="9:16")
            				flag=1;
            			break;
            		case 3:
            			if(str1!="1:1")
            				flag=1;
            			break;
            		default:
            			break;
            	}
            	if(flag==1){
            		toastr.options.timeOut=3000;
            		toastr.options.preventDuplicates="true";
            		toastr.error("INCOMPATIBLE ASTON FOR THIS ASPECT RATIO!");
            		document.getElementById("gif1").style.opacity="0.2";
            	}
            }


             $("#sub").click(function(){			// when submit is clicked
             	
                onSelectRes();
                $("#img_canvas").width(can_width).height(can_height);
                //console.log(can_width+" , "+can_height+"\n");
                var asp=document.getElementById("aspect_ratio");
                var str1=asp.options[asp.selectedIndex].value;
                if(str1=="9:16")
                	$("#sub").css({"margin-top":"50%"});
                else if(str1=="16:9")
                	$("#sub").css({"margin-top":"50%"});
                else if(str1=="1:1")
                	$("#sub").css({"margin-top":"50%"});
                else if(str1=="4:3")
                	$("#sub").css({"margin-top":"30%"});
                else if(str1=="3:4")
                	$("#sub").css({"margin-top":"60%"});
                checkAston();
                var curDate=new Date();
                var cur=curDate.getHours()+"-"+curDate.getMinutes()+"-"+curDate.getSeconds()+"-";
                 var curTime=cur+""+curDate.getDate()+"-"+curDate.getFullYear();
                 //alert(curTime);
                 var file = new Object();
                 //console.log(document.getElementById('text_case').options);
                 file.texttype=$("#text_type").val();
                 file.textname=$("#text_name").val();
                 file.type_case=document.getElementById('text_case').options[document.getElementById('text_case').selectedIndex].innerHTML;
                 file.canvas_size_width=(($('#canvas_size_width').val())/100)*can_width;
                 file.canvas_size_height=(($('#canvas_size_height').val())/100)*can_height;
                 file.text_align=$('#text_align').val();
                 file.text_padding=($('#text_padding').val()*file.canvas_size_width)/100;
                 file.max_line=$('#max_line').val();
                 file.get_between_lines=$('#get_between_lines').val();
                 file.bg_type_val="";
                 if(bgVal=='yes'){
                    file.bg_type=$('#bgselect').val();
                    if(file.bg_type=='color')
                        file.bg_type_val=hexToRgbA($('#color').val());
                    else if(file.bg_type=='video')
                        file.bg_type_val=$('#video').val();
                    else if(file.bg_type=='image')
                        file.bg_type_val=$('#image').val();
                 }
                 file.tbg_type_val="";
                 if(tbgVal=='yes'){
                    file.tbg_type=$('#tbgselect').val();
                    if(file.tbg_type=='color')
                        file.tbg_type_val=hexToRgbA($('#tcolor').val());
                    else if(file.tbg_type=='video')
                        file.tbg_type_val=$('#tvideo').val();
                    else if(file.tbg_type=='image')
                        file.tbg_type_val=$('#timage').val();
                 }
                 file.textval=onSelectCase($('#text_val').val());
                 file.font_size=$('#font_size').val();
                 file.font=$('#drop_family').val();
                 var ttf_str=$('#drop_family').val().replace(" ", "").toLowerCase();
                 var ttf_str2=$('#drop_family').val().replace(" ", "");
                 var ttf=$('#drop_style').val();
                 try{
                 var ttf_int=parseInt(ttf[0]);
                 switch(ttf_int){
                    case 1:
                        if(ttf.length!=3)
                            ttf="Thin"+ttf[3].toUpperCase().substring(4);
                        else
                            ttf="Thin";
                        break;
                    case 2:
                        if(ttf.length!=3)
                            ttf="Extra Light"+ttf[3].toUpperCase().substring(4);
                        else
                            ttf="Extra Light";
                        break;
                    case 3:
                        if(ttf.length!=3)
                            ttf="Light"+ttf[3].toUpperCase().substring(4);
                        else
                            ttf="Light";
                        break;
                    case 4:
                        if(ttf.length!=3)
                            ttf="Normal"+ttf[3].toUpperCase().substring(4);
                        else
                            ttf="Normal";
                        break;
                    case 5:
                        if(ttf.length!=3){
                            ttf="Medium"+ttf[3].toUpperCase().substring(4);
                        }
                        else{
                            ttf="Medium";
                        }
                        break;
                    case 6:
                        if(ttf.length!=3)
                            ttf="Semi Bold"+ttf[3].toUpperCase().substring(4);
                        else
                            ttf="Semi Bold";
                        break;
                    case 7:
                        if(ttf.length!=3)
                            ttf="Bold"+ttf[3].toUpperCase().substring(4);
                        else
                            ttf="Bold";
                        break;
                    case 8:
                        if(ttf.length!=3)
                            ttf="Extra Bold"+ttf[3].toUpperCase().substring(4);
                        else
                            ttf="Extra Bold";
                        break;
                    case 9:
                        if(ttf.length!=3)
                            ttf="Black"+ttf[3].toUpperCase().substring(4);
                        else
                            ttf="Black";
                        break;
                    default:
                        ttf=ttf[0].toUpperCase()+ttf.substring(1);
                 }
                    //ttf=ttf[0].toUpperCase()+ttf.substring(1);
                    
                 file.font_ttf="googlefonts/"+ttf_str+"/"+ttf_str2+"-"+ttf+".ttf";
            }
            catch(e){
                alert("Please select a font type and font style");
            }
                 file.text_color=hexToRgbA($("#txcolor").val());
                 if(strokeVal=='yes'){
                    file.stroke_width=$("#stroke_width").val();
                    file.strcolor=hexToRgbA($("#strcolor").val());
                 }
                 if(shVal=='yes'){
                    file.sh_color=hexToRgbA($("#shcolor").val());
                    file.sh_x=$("#shx").val();
                    file.sh_y=$("#shy").val();
                    file.sh_blur=$("shBlur").val();
                 }
                 file.HLtextval=onSelectCase($('#HLtext_val').val());
                 file.HLfont_size=$('#HLfont_size').val();
                 file.HLfont=$('#HLdrop_family').val();
                 var ttf_str1=$('#HLdrop_family').val().replace(" ","").toLowerCase();
                 var ttf_str21=$('#HLdrop_family').val().replace(" ","");
                 var ttf1=$('#HLdrop_style').val();
            try{
                 var HLttf_int=parseInt(ttf1[0]);
                 switch(HLttf_int){
                    case 1:
                        if(ttf1.length!=3)
                            ttf1="Thin"+ttf1[3].toUpperCase().substring(4);
                        else
                            ttf1="Thin";
                        break;
                    case 2:
                        if(ttf1.length!=3)
                            ttf1="Extra Light"+ttf1[3].toUpperCase().substring(4);
                        else
                            ttf1="Extra Light";
                        break;
                    case 3:
                        if(ttf1.length!=3)
                            ttf1="Light"+ttf1[3].toUpperCase().substring(4);
                        else
                            ttf1="Light";
                        break;
                    case 4:
                        if(ttf1.length!=3)
                            ttf1="Normal"+ttf1[3].toUpperCase().substring(4);
                        else
                            ttf1="Normal";
                        break;
                    case 5:
                        if(ttf1.length!=3){
                            ttf1="Medium"+ttf1[3].toUpperCase().substring(4);
                        }
                        else{
                            ttf1="Medium";
                        }
                        break;
                    case 6:
                        if(ttf1.length!=3)
                            ttf1="Semi Bold"+ttf1[3].toUpperCase().substring(4);
                        else
                            ttf1="Semi Bold";
                        break;
                    case 7:
                        if(ttf1.length!=3)
                            ttf1="Bold"+ttf1[3].toUpperCase().substring(4);
                        else
                            ttf1="Bold";
                        break;
                    case 8:
                        if(ttf1.length!=3)
                            ttf1="Extra Bold"+ttf1[3].toUpperCase().substring(4);
                        else
                            ttf1="Extra Bold";
                        break;
                    case 9:
                        if(ttf1.length!=3)
                            ttf1="Black"+ttf1[3].toUpperCase().substring(4);
                        else
                            ttf1="Black";
                        break;
                    default:
                        ttf1=ttf1[0].toUpperCase()+ttf1.substring(1);
                 }
                    //ttf=ttf[0].toUpperCase()+ttf.substring(1);
                    
                 file.HLfont_ttf="googlefonts/"+ttf_str1+"/"+ttf_str21+"-"+ttf1+".ttf";
            }
            catch(e){
                alert("Please select a font type and font style");
            }
            file.HLtext_color=hexToRgbA($("#HLtxcolor").val());
                 if(HLstrokeVal=='yes'){
                    file.HLstroke_width=hexToRgbA($("#HLstroke_width").val());
                    file.HLstrcolor=$("#HLstrcolor").val();
                 }
                 if(HLshVal=='yes'){
                    file.HLsh_color=hexToRgbA($("#HLshcolor").val());
                    file.HLSh_x=$("#HLshx").val();
                    file.HLSh_y=$("#HLshy").val();
                    file.HLSh_blur=$("#HLshBlur").val();
                 }

                 console.log(file);
                 save(file);

                 var urlstr="http://video.gistai.com:60050/animation?finalFileName=TEXT-"+curTime+"&finalImagePath=/var/www/createvideo/ajax/quintimages/&texttType="+file.texttype+"&textName="+file.textname+"&typeCase="+file.type_case+"&textAnimationType=wipe&canvasSize="+file.canvas_size_width+","+file.canvas_size_height+"&textAlign="+file.text_align+"&padding="+file.text_padding+"&maxLine="+file.max_line+"&getbetweentwoline="+file.get_between_lines+"&bgyn&="+bgVal+"&bgtype="+file.bg_type+"&bg="+file.bg_type_val+"&textBgyn="+tbgVal+"&textBgtype="+file.tbg_type+"&textbgoption=3&textBgColor="+file.tbg_type_val+"&textBgGradient=none&text="+file.textval+"&fontFile="+file.font_ttf+"&fontName="+file.font+"&fontSize="+file.font_size+"&textColor="+file.text_color+"&strokeVisible="+strokeVal+"&strokeWidth="+file.stroke_width+"&strokeColor="+file.strColor+"&shadowyn="+shVal+"&shadowColor="+file.sh_color+"&shadowX="+file.sh_x+"&shadowY="+file.sh_y+"&shadowBlur="+file.sh_blur+"&highlightText="+file.HLtextval+"&HLFontFile="+file.HLfont_ttf+"&HLFontName="+file.HLfont+"&HLFontSize="+file.HLfont_size+"&HLTextColor="+file.HLtext_color+"&HLStrokeVisible="+HLstrokeVal+"&HLStrokewidth="+file.HLstroke_width+"&HLStrokeColor="+file.HLstrcolor+"&HLShadowyn="+HLshVal+"&HLShadowColor="+file.HLSh_color+"&HLShadowX="+file.HLSh_x+"&HLShadowY="+file.HLSh_y+"&HLShadowBlur="+file.HLSh_blur+"&decorationyn=no&decoration=[[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27]]%3C__%3E[[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27]]%3C__%3E[[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27]]%3C__%3E[[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27]]%3C__%3E[[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27],%20[u%270%27,%20u%270%27,%20u%270%27,%20u%27255,255,255,1%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27,%20u%27%27]]"

                 //console.log("http://video.gistai.com/createvideo/ajax/quintimages/"+file.name+"-"+curTime);

                 //var urlstr2="http://video.gistai.com:60050/animation?finalFileName=TEXT-"+curTime+"&finalImagePath=/var/www/createvideo/ajax/quintimages/&textType=StoryName&textName=Carpet&typeCase=lower&textAnimationType=wipe&canvasSize="+file.canvas_size_width+","+file.canvas_size_height+"&textAlign=center&padding=10&maxLine=2&getbetweentwoline=-10&bgyn&=no&bgtype=video&bg=http://api3.gistai.com/Intro-Outro/backgrounds/clip3-line&textBgyn=no&textBgtype=color&textbgoption=3&textBgColor=0,0,0,0.6&textBgGradient=none&text=%E0%A4%87%E0%A4%B8%20%E0%A4%AE%E0%A4%BE%E0%A4%AE%E0%A4%B2%E0%A5%87%20%E0%A4%AE%E0%A5%87%E0%A4%82%20%E0%A4%B9%E0%A5%88%E0%A4%82%20%E0%A4%97%E0%A4%82%E0%A4%AD%E0%A5%80%E0%A4%B0%E0%A4%87%E0%A4%B8%20%E0%A4%AE%E0%A4%BE%E0%A4%AE%E0%A4%B2%E0%A5%87%20%E0%A4%AE%E0%A5%87%E0%A4%82%20%E0%A4%B9%E0%A5%88%E0%A4%82%20%E0%A4%97%E0%A4%82%E0%A4%AD%E0%A5%80%E0%A4%B0%2C%20%E0%A4%85%E0%A4%A8%E0%A5%81%E0%A4%B7%E0%A5%8D%E0%A4%95%E0%A4%BE%20%E0%A4%95%E0%A5%8B%20%E0%A4%A8%E0%A4%B9%E0%A5%80%E0%A4%82%20%E0%A4%95%E0%A4%B0%E0%A4%A8%E0%A5%87%20%E0%A4%A6%E0%A5%80%20%E0%A4%A5%E0%A5%80%20%E0%A4%B6%E0%A4%BE%E0%A4%A6%E0%A5%80&fontFile=HelveticaNeueBold.ttf&fontName=Helvetica Neue&fontSize=20&textColor=255,255,255,1&strokeVisible=no&strokeWidth=0&strokeColor=0,0,0,0&shadowyn=no&shadowColor=0,0,0,0&shadowX=0&shadowY=0&shadowBlur=0&highlightText=&HLFontFile=HelveticaNeueBold.ttf&HLFontName=Helvetica Neue&HLFontSize=25&HLTextColor=255,255,255,1&HLStrokeVisible=no&HLStrokewidth=0&HLStrokeColor=0,0,0,0&HLShadowyn=no&HLShadowColor=0,0,0,0&HLShadowX=0&HLShadowY=0&HLShadowBlur=0&decorationyn=no&decoration=[[u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u'']]<__>[[u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u'']]<__>[[u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u'']]<__>[[u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u'']]<__>[[u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u''], [u'0', u'0', u'0', u'255,255,255,1', u'', u'', u'', u'', u'', u'']]"
 
                 

                 function drawImage(){			// to draw the text that is retrieved 
                        var img=document.getElementById('image1');
                        var x=$('#tx').val();
                        var y=$('#ty').val();
                        $("#image1").css("position","absolute");
                        $("#image1").css("top",y+"px");
                        $("#image1").css("left",x+"px");
                    }

                    

                 function setImages(){    // to set the text that is retrieved
                    $("#image1").on('load',function(){
                    	toastr.options.timeOut=3000;
                    	toastr.options.preventDuplicates="true";
                    	toastr.success("SUCCESSFULLY LOADED IMAGE");
                        // $("#image1").resizable({
                        // 	maxHeight: 406,
                        // 	maxWidth: 720,
                        // });
                        // $("#image1").resizable({
                        // 	//containment: "#img_canvas",
                        // 	// ghost: true,
                        // 	maxHeight: 406,
                        // 	maxWidth: 720,
                        // 	start: function(e,ui){
                        // 		// document.getElementById("image1").style.display="none";
                        // 	},
                        // 	stop: function(event,ui){
                        // 		document.getElementById('canvas_size_height').value=ui.size.height*(100/can_width);
                        // 		document.getElementById('canvas_size_width').value=ui.size.width*(100/can_width);
                        // 		// $("sub").click();
                        // 		//document.getElementById("tx").value=""+(ui.position.left+1);
                        //         //document.getElementById("ty").value=""+(ui.position.top+1);
                        // 	}
                        // });
                        
                        $("#image1").draggable({
                        	containment: "parent",
                            stop: function(event,ui){
                                if(border_flag==1){
                                    origin=ui;
                                    document.getElementById("tx").value=""+(ui.position.left+1);
                                    document.getElementById("ty").value=""+(ui.position.top+1);
                                }
                                else{
                                    document.getElementById("tx").value=""+ui.position.left;
                                    document.getElementById("ty").value=""+ui.position.top;
                                }
                            }
                        });
                        // $("#image1").resizable();
                        // $("#img_div").draggable();
                        drawImage();
                    });
                }


                	// $("#dragbtn").on('click',function(){

                		
                	// 	$("#image1").resizable("option","disabled",true);
                	// 	$("#img_div").draggable("option","disabled",false);
                	// 	$("#img_div").draggable({
                 //            stop: function(event,ui){
                 //                if(border_flag==1){
                 //                    origin=ui;
                 //                    document.getElementById("tx").value=""+(ui.position.left+1);
                 //                    document.getElementById("ty").value=""+(ui.position.top+1);
                 //                }
                 //                else{
                 //                    document.getElementById("tx").value=""+ui.position.left;
                 //                    document.getElementById("ty").value=""+ui.position.top;
                 //                }
                 //            }
                 //        });
                	// });

                	// $("#resizebtn").on('click',function(){
                		
                	// 	$("#img_div").draggable("option","disabled",true);
                	// 	$("#image1").resizable("option","disabled",false);
                	// 	$("#image1").resizable({
                 //        	//containment: "#img_canvas",
                 //        	// ghost: true,
                 //        	maxHeight: 406,
                 //        	maxWidth: 720,
                 //        	start: function(e,ui){
                 //        		// document.getElementById("image1").style.display="none";
                 //        	},
                 //        	stop: function(event,ui){
                 //        		document.getElementById('canvas_size_height').value=ui.size.height*(100/can_width);
                 //        		document.getElementById('canvas_size_width').value=ui.size.width*(100/can_width);
                 //        		// $("sub").click();
                 //        		//document.getElementById("tx").value=""+(ui.position.left+1);
                 //                //document.getElementById("ty").value=""+(ui.position.top+1);
                 //        	}
                 //        });
                	// });  

                    $("#tx").on('change',function(){
                        //console.log('x changed');
                        drawImage();
                    });


                    $("#ty").on('change',function(){
                        //console.log('y changed');
                        drawImage();
                    });

                 $.ajax({					// ajax call to the api
                     'url': urlstr,
                     'method': 'GET',
                     'datatype': 'json',
                     error : function(data){
                        console.log("error");
                        console.log(data);
                     },
                     success : function(data){
                        $("#image1").attr("src","http://video.gistai.com/createvideo/ajax/quintimages/TEXT-"+curTime);
                        $("#x-cd").css("display","block");
                        $("#y-cd").css("display","block");
                        $("#border-select").css("display","block");
                        setImages();    
                     }
                 });
 
                
             });
         });

</script>

</html>
