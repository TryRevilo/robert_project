<?php
$images = elgg_extract('entities', $vars, FALSE);

echo elgg_view_entity_list($images, [
	'item_view' => 'rentals/other_rooms_owned/other_rooms_owned_item_view',
	'no_results' => 'Only one room published',
	]);
	?>

	<div class="clearfix"> </div>
	<div class="room-full-view-frame"></div>