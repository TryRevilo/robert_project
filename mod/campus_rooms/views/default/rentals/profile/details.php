<?php

$room = elgg_extract('entity', $vars, false);
$room_name = $room -> title;
$description = $room -> description;

echo <<<ROOM_DETAILS
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3"><label class="details-title">Room name</label></div>
		<div class="col-md-9">$room_name</div>
	</div>
	<div class="row">
		<div class="col-md-3"><label class="details-title">Description</label></div>
		<div class="col-md-9">$description</div>
	</div>
</div>
ROOM_DETAILS;

?>

<style type="text/css">
	
	.details-title {
		font-weight: bold;
		font-size: 90%;
		width: 90px;
	}

</style>

