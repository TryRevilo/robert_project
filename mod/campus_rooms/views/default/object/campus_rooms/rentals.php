<style type="text/css">

	/** views/default/object/rentals **/

	.item-name {
		font-size: 110%;
		padding: 3px 0;
	}

	.desc_room {
		font-size: 90%;
		margin: 4px 0;
	}

	.a-cast {
		position: relative;
		display: block;
		padding: 3px 5px 3px 3px !important;
	}

	.badge {
		display: inline-block;
		min-width: 10px;
		padding: 3px 7px;
		font-size: 90% !important;
		font-weight: normal !important;
		line-height: 1;
		color: #444 !important;
		text-align: center;
		white-space: nowrap;
		vertical-align: middle;
		background-color: #FFF;
		border-radius: 10px;
	}

	.hover-override {
		text-decoration: none;
		background-color: #eee;
	}

	.ajax_output {
		color: #333;
		font-weight: bold;
		padding: 10px;
		font-size: 17px;
		min-height: 52px;
		min-width: 55px;
		background-color: #F7F7F7;
		margin-bottom: 7px;
	}

	.myplugin-form-container {
		min-height: 55px;
		width: 100%;
		padding: 5px;
		background-color: #F7F7F7;
	}

	.media {
		margin-top: -1px !important;
	}

	.alert {
		padding: 10px !important;
		margin-bottom: 10px !important;
		border: 1px solid transparent;
		border-radius: 0 !important;
	}

	.elgg-menu-filter > li {
		float: left;
		border: 1px solid #DCDCDC;
		border-bottom: 0;
		background: #eee;
		margin: 0 0 0 5px;
		border-radius: 0 !important;
	}

</style>


<?php

$room = elgg_extract('entity', $vars, FALSE);

$room_icon = elgg_view_entity_icon($room, 'small', array(
	'use_hover' => false,
	'use_link' => false,
	'img_class' => 'photo u-photo',
	));

// $room_icon = elgg_view_entity_icon($room, 'medium');
$room_name = elgg_extract('title', $vars, '');
if ($room_name === '') {
	if (isset($room->title)) {
		$text = $room->title;
	} else {
		$text = $room->name;
	}
	$params = array(
		'text' => elgg_get_excerpt($text, 100),
		'href' => $room->getURL() . 'rooms/room/' . $room -> guid,
		'is_trusted' => true,
		);
	$room_name = elgg_view('output/url', $params);
}

// $room_name = $room->getURL();
$description = $room -> description;

if ($room_name == '') {
	$room_name = "Name not set";
}

if ($description == '') {
	$description = "No description has been set yet";
}

$test_icon = elgg_view_icon('cloud-upload');

?>

<div class="media clearfix">
	<div class="media-left media-top">
		<a class="media-object" href="#">
			<?php echo $room_icon; ?>
		</a>
	</div>
	<div class="media-body">
		<div class="item-name"><?php echo $room_name; ?></div>
		<ul class="nav nav-pills" role="tablist">
			<li role="presentation" class="active">
				<a class="a-cast" href="#"><span class="badge">
					<?php echo elgg_view_icon('anchor'); ?>42</span>
				</a>
			</li>

			<li role="presentation">
				<a class="a-cast" href="#"><span class="badge">
					<?php echo elgg_view_icon('thumbs-o-up'); ?>1,222</span>
				</a>
			</li>

			<li role="presentation">
				<a class="a-cast" href="#"><span class="badge">
					<?php echo elgg_view_icon('envelope-o'); ?></span>
				</a>
			</li>

			<li role="presentation">
				<a class="a-cast" href="#"><span class="badge">
					<?php echo elgg_view_icon('user'); ?></span>
				</a>
			</li>

			<li role="presentation">
				<a class="a-cast" href=""><span class="badge ajax-caller">
					<?php echo elgg_view_icon('edit'); ?></span>
				</a>
			</li>
		</ul>
		<div class="desc_room"><?php echo $description; ?></div>

		<div> 
			<?php			
			$vars = array('container_guid' => $room -> guid,);
			echo elgg_view('albums/photos', $vars); 
			?> 
		</div>

	</div>
</div>