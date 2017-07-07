<?php

$room = elgg_extract('entity', $vars, false);
$price = $room -> room_price;
$location = $room -> room_location;

echo <<<ROOM_DETAILS
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3"><span class="price-text">Price : </span><label class="details-title-price"> $price</label></div>
		<div class="col-md-9"><span class="details-location">$location</span></div>
	</div>

	<div class="separator"></div>
</div>
ROOM_DETAILS;

?>

<style type="text/css">
	
	.price-text {
		font-weight: bold;
		font-size: 100%;
	}

	.details-title-price {
		font-size: 130%;
		font-weight: normal;
		color: #666 !important;
	}

	.details-location {
		font-size: 120%;
		font-weight: normal;
		color: #666 !important;
	}

	.separator {
		padding-bottom: 10px;
	}

</style>

