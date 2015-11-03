<?php
$the_javascript_and_style = '<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	.round-button {
	    width: 10%;
	    height: 0;
	    padding-bottom: 10%;
	    border-radius: 50%;
	    border: 2px solid #f5f5f5;
	    overflow: hidden;
	    background: blue;
	    box-shadow: 0 0 3px blue;
	}
</style>
	

<script>


var Side_Panel_Text_Map = Array();
Side_Panel_Text_Map["home_submit"] = "Home";
Side_Panel_Text_Map["resume_submit"] = "Resume";
Side_Panel_Text_Map["attribute_changer_submit"] = "Attribute Changer";
Side_Panel_Text_Map["email_submit"] = "Email";
Side_Panel_Text_Map["game_submit"] = "Game";
Side_Panel_Text_Map["other_submit"] = "Other";

function Side_Panel_Button_Mouseover(e){



 	var button_text_div = document.createElement("DIV");
 	button_text_div.style.marginLeft = (100-parseInt(e.style.right) + 1).toString() + "%";
 	button_text_div.style.top = e.style.top;
 	button_text_div.style.position = e.style.position;


 	var the_text = document.createElement("DIV");

 	button_text_div.appendChild(the_text);
 	the_text.innerHTML = Side_Panel_Text_Map[e.name];
 	


 	e.parentNode.appendChild(button_text_div);
 	the_text.style.marginTop = "17px";

 	the_text.style.marginRight= "-40px";
 	button_text_div.style.float = "left";
}

function Side_Panel_Button_Mouseout(e) {
	//window.alert(e.tagName);
	var parent = e.parentNode;
	
	var child_list = Array();

	for (var i = 0; i < parent.childNodes.length; i++) {
		if(parent.childNodes[i].tagName != "INPUT") {
			child_list.push(parent.childNodes[i]);
		}
	}
	for(var i=0; i<child_list.length; i++){
		parent.removeChild(child_list[i]);
	}
}

function Side_Panel_Button_Clicked(e){
	document.getElementById("side_panel_form_value").value = e.name;
}

</script>';

$the_front = '
</head>
<body>

<div id="main_body" style="left:30%;height:100%;width:40%;position:absolute">
		<div id="image_div" style="align:center">

			<img src="/LsPfEpve4X2Kj_-h59sHzmP3sgNKCIuY1_LW_Zwl8RA.jpeg" alt="Picture Of Marcel" style="display:block; margin-left:auto; margin-right:auto; margin-top:200px; width:160px">

		</div>
		<div id="profile_text_div" style="margin-top:10%">
			Marcel Mongeon<br>
			Computer Engineer<br><br>

			With a focus on the future, making decisions for today
		</div>
	</div>
	<div id="oauth_login_div" style="margin-right:15%; margin-top:5%; float:right;">
			<input type="submit" name="oauth_login" value="oauth_login" >
			</input>
	</div>';

$resume_page = '</head>
<body>

<div id="main_body" style="left:30%;height:100%;width:65%;position:absolute"><iframe src="/Mongeon,Marcel.html" style="height:100%;width:100%"></iframe>';
if(isset($_POST['side_panel_form_value']) && $_POST['side_panel_form_value'] != '') {

	if($_POST['side_panel_form_value'] == 'resume_submit') {
		$side_panel = Create_Side_Panel('resume_submit');
		print($the_javascript_and_style.$side_panel.$resume_page.'</div></body></html>');
		return;
	}

	else if($_POST['side_panel_form_value'] == 'attribute_changer_submit') {
		$side_panel = Create_Side_Panel('attribute_changer_submit');
	}
	else if($_POST['side_panel_form_value'] == 'email_submit') {
		$side_panel = Create_Side_Panel('email_submit');
	}
	else if($_POST['side_panel_form_value'] == 'game_submit') {
		$side_panel = Create_Side_Panel('game_submit');
	}
	else if($_POST['side_panel_form_value'] == 'other_submit') {
		$side_panel = Create_Side_Panel('other_submit');
	}

	else if($_POST['side_panel_form_value'] == 'home_submit') {

		$side_panel = Create_Side_Panel('home_submit');
	}

}
else{

	$side_panel = Create_Side_Panel('home_submit');
}

print($the_javascript_and_style.$side_panel.$the_front.'</div></body></html>');



function Create_Side_Panel($clicked_type){
	
	$side_panel_button_types = array(
		'home_submit' => array( 'text' =>'Home', 'right'=> 10, 'top'=>0),
		'resume_submit' => array( 'text' =>'Resume', 'right'=> 20, 'top'=>10),
		'attribute_changer_submit' => array( 'text' =>'Attribute Changer', 'right'=> 30, 'top'=>20),
		'email_submit' => array( 'text' =>'Email', 'right'=> 40, 'top'=>30),
		'game_submit' => array( 'text' =>'Game', 'right'=> 50, 'top'=>40),
		'other_submit' => array( 'text' =>'Other', 'right'=> 60, 'top'=>50),

	);

	//print_r($side_panel_button_types);
	$return_html = '
	<div id="left_panel" style="width:30%;height:600px; margin-top:5%; overflow:visible;position:absolute;">
	
		<form name="side_panel_form" method="post" action="portfolio_home.php">

			<input type="hidden" value="" id="side_panel_form_value" name="side_panel_form_value">
			</input>';



	foreach ($side_panel_button_types as $type => $style) {

		if($clicked_type == $type) {
			

			$return_html .= sprintf('
			<div>
				<input type="submit" class="round-button" name="%s" value="" onclick ="Side_Panel_Button_Clicked(this)" onmouseover="" onmouseout="" style="right:%s; top: %s; position:absolute;">			
				</input>

				<div style="margin-left: %s; top: %s; position: absolute; float: left;">
					<div style="margin-top: 17px; margin-right: -40px;">
						%s
					</div>
				</div>
			</div>', $type, strval($style['right']).'%', strval($style['top']).'%', strval(100 - $style['right'] + 1).'%', strval($style['top']).'%', $style['text']);
		}
		else{

			$return_html .= sprintf('<div>
				<input type="submit" class="round-button" name="%s" value="" onclick ="Side_Panel_Button_Clicked(this)" onmouseover="Side_Panel_Button_Mouseover(this)" onmouseout="Side_Panel_Button_Mouseout(this)" style="right:%s; top: %s; position:absolute;">			
				</input>

			</div>', $type, strval($style['right']).'%', strval($style['top']).'%' ) ;
		}
	}

	$return_html .= '</form> </div>';

	return $return_html;
}

?>
