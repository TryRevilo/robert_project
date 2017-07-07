<?php

$image_guid = get_input('guid');
$image = get_entity($image_guid);
$img = elgg_view_entity_icon($image, 'large');

?>

<div class="pics-profile-wrapper">
	<?php 
	echo $img;
	?>
</div>