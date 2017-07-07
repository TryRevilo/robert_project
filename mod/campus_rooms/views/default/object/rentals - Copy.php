<style>
.rooms_wrapper {
	background-color: lightgrey;
	width: 100%;
	padding: 0 10px;
}
.left {
	float: left;
	width: 200px;
	background-color: #C5F09E;
}
.center {
	float: left;
	width: 100%;
	min-height: 55px;
	padding: 4px;
	background-color: #DFC9CA;
}
.clearfix:after {
	visibility: hidden;
	display: block;
	font-size: 0;
	content: " ";
	clear: both;
	height: 0;
}
.clearfix {
	display: inline-block;
}
/* start commented backslash hack \*/
* html .clearfix {
	height: 1%;
}
.clearfix {
	display: block;
}
/* close commented backslash hack */
</style>
<?php

$room = elgg_extract('entity', $vars, FALSE);

$room_icon = elgg_view_entity_icon($room, 'medium');
$room_name = $room -> title;

if ($room_name == '') {
	$room_name = "Name not set";
}

?>

<div class="rooms_wrapper clearfix">
  <div class="left"> <?php echo $room_icon; ?> </div>
  <div class="center"><?php echo $room_name; ?></div>
</div>
