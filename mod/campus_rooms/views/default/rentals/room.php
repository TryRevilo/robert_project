<style type="text/css">
	
	.owner-icon {
		width: 255px;
		height: auto;
	}

	.form-control {
		border: 1px solid #dff0d8 !important;
		border-radius: 0 !important;
		-webkit-box-shadow: none !important;
		box-shadow: none !important;
		-webkit-transition: none !important;
		-o-transition: none !important;
		transition: none !important;
	}

	.info-content {
		margin-left: 3px;
	}

	body > div > div.cast-main-content > div > div > div.col-md-10 > div > div > div > div.elgg-layout.elgg-layout-one-sidebar.clearfix > div > div > div.col-md-8 > div > div > div > div > div.col-xs-3 > div.user-icon > a > img {
		max-width: 170px !important;
		height: auto;
	}

	.user-icon {
		min-width: 170px !important;
		max-width: 170px !important;
		height: auto;
		margin-top: 4px;
		margin-left: 5px;
	}

	.edit-profile-options {
		margin-top: 12px;
		font-size: 90%;
	}

	.pll, .phl {
		padding-left: 0 !important;
	}

	.profile-details-container {
		margin-left: 22px;
		width: 427px;
		min-height: 155px;
	}

	.profile-details {
		font-size: 90%;
		margin-left: 10px;
		min-height: 51px;
	}

	.upload-icon-tab {
		font-size: 15px;
		padding: 4px 4px;
		border: 1px solid #dff0d8;
		border-bottom: none;
	}

	.content-title {
		font-size: 100%;
		font-weight: 500;
		padding-bottom: 1px;
		margin-top: 22px;
		margin-right: -12px;
		margin-left: 7px;
		border-bottom: 1px #dff0d8 solid;
	}

	.extras-content-title {
		font-size: 100%;
		font-weight: 500;
		padding-right: 12px;
		margin: 22px 0;
		border-bottom: 1px #dff0d8 solid;
	}

	.extras-content-title-text {
		font-size: 90%;
		font-weight: bold;
	}

	.pics-profile-wrapper {
		margin-left: 7px;
	}

	.pics-profile-wrapper > .elgg-list > li {
		padding-right: 0;
		border: none;
	}

	.room-details-profile-wrapper {
		padding-top: 12px;
		margin-left: 7px;
	}
	
	.elgg-photo {
		border: 1px solid #dff0d8 !important;
		padding: 5px;
		background-color: #FFF;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		max-width: 100% !important;
		height: auto;
	}

	.elgg-module-tidypics-album, .elgg-module-tidypics-image {
		width: 100% !important;
		text-align: left;
		margin: 5px 5px;
	}

	.tidypics-gallery-widget > li {
		width: auto !important;
	}
	
	.elgg-photo {
		border: 1px solid #dff0d8 !important;
		padding: 5px;
		background-color: #FFF;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		max-width: 100% !important;
		height: auto;
	}

	.tidypics-gallery-widget > li {
		width: 86px !important;
		margin: 3px;
	}

	.profile-options-container {
		margin-top: 48px;
	}

	.user-stats {
		padding: 5px;
		padding-bottom: 10px;
		margin-top: 5px;
		min-height: 123px;
		border: 1px solid #dff0d8;
		border-right: none;
		background-color: #F7F7F7;
	}

	.anchor-view {
		margin-top: 2px;
	}

	.anchor-view-icon {
		font-size: 100%;
	}

	.pointing-text {
		font-size: 90%;
		color: #666 !important;
		font-weight: bold;
	}

	.pointing-text-tell {
		font-size: 87%;
		color: #666 !important;
	}

	.a-cast-wrapper {
		float: left;
	}

	.check-out-wrapper {
		margin-left: 4px;
	}

	.a-cast {
		font-size: 37px;
		color: blue !important
		float: left;
	}

	.a-cast-point-txt {
		font-size: 17px;
		color: blue !important;
		margin-left: -8px;
	}

	.a-cast-add-minus {
		font-size: 19px;
	}

	.pointer-options .fa-thumbs-o-up {
		color: blue !important;
	}

	.pointer-options .fa-bookmark-o {
		color: blue !important;
	}

	.pointer-options .fa-plus-square-o {
		color: #31DE0D !important;
	}

	.pointer-options .fa-minus-square-o {
		color: #FF4F90 !important;
	}

	.reserve-button {
		font-size: 100%;
		font-weight: 500;
		color: #FFF;
		cursor: pointer;
		text-align: center;
		padding: 4px 10px;
		margin-left: 4px;
		width: 172px;
		border: 1px solid #dff0d8;
		background-color: #74B52C;
	}

	.reserve-button a {
		color: #FFF !important;
	}

	.reserve-button-occupied {
		background-color: #E8317C !important;
	}

	.reservation-requests-container {
		margin-left: 7px;
	}

	.reserve-button-approval-pending {
		background-color: #FFAC55 !important;
	}

	.reservation-button-approved {
		background-color: #11DD21 !important;
	}

	.check-out-tell {
		font-size: 100%;
		font-weight: 500;
	}
	

</style>

<?php 

$room = elgg_extract('entity', $vars, FALSE);
$room_owner = $room -> getOwnerEntity();
$room_owner_guid = $room_owner -> guid;
$room_guid = $room -> guid;

$owner_names = $room_owner -> name;

// Check if room occupied

$db_prefix = elgg_get_config('dbprefix');

$requests = elgg_get_entities_from_relationship(array(
	'type' => 'user',
	'relationship' => 'room_occupied',
	'relationship_guid' => $room_guid,
	'inverse_relationship' => true,
	'limit' => 0,
	));

$url_request_reservation = elgg_get_site_url() . "/action/reservations/request_reservation?room_guid={$room_guid}";
$params_request_reservation = array(
	'href' => $url_request_reservation,
	'text' => elgg_echo('Continue to checkout'),
	'title' => elgg_echo('Rev:reservations:delete'),
	'is_action' => true,
	'is_trusted' => true,
	);

$request_reservation = elgg_view('output/url', $params_request_reservation);

$reservation_button;

if (!empty($requests)) {
	$reservation_button = '<label class="reserve-button reserve-button-occupied" >Occupied</label>';

	if (check_entity_relationship(elgg_get_logged_in_user_guid(), 'room_occupied', $room_guid)) {
		$reservation_button = '<label class="reserve-button reservation-button-approved" >Reservation approved</label>';
	}
} else {
	$reservation_button ='<label class="reserve-button">' . $request_reservation . '</label>';
}

if (check_entity_relationship(elgg_get_logged_in_user_guid(), 'reservation_request', $room_guid)) {
    // Reservation relationship exists
	$reservation_button ='<label class="reserve-button reserve-button-approval-pending" >Reservation Successful</label>';
}

?>

<?php 

$form_vars = array('enctype' => 'multipart/form-data');
echo elgg_view_form('service_comments/add_service_comment', $form_vars);

?>

<div class="clearfix"> </div>

<div class="info-content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-1">
				<div class="profile-options-container">
					<p>
						<a href="">
							<span class="edit-profile-options" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
								<?php echo elgg_view_icon('crop') . ' Edit'; ?>
							</span>
						</a>
					</p>
					<p>
						<a href="">
							<span class="edit-profile-options"><?php echo elgg_view_icon('camera') . ' Icon'; ?></span>
						</a>
					</p>
					<p>
						<a href="">
							<span class="edit-profile-options"><?php echo elgg_view_icon('envelope') . ' Mail'; ?>
							</span>
						</a>
					</p>
				</div>
			</div>
			<div class="col-xs-3">
				<div class="check-out-wrapper clearfix">
					<div class="a-cast-wrapper">
						<a class="a-cast" href="#"><?php echo elgg_view_icon('anchor'); ?></a>
					</div>
					<div class="pointer-options">
						<a class="a-cast-point-txt" href="#">42</a>
						<a class="a-cast-add-minus" href="#"><?php echo elgg_view_icon('plus-square-o'); ?></a>
						<a class="a-cast-add-minus" href="#"><?php echo elgg_view_icon('minus-square-o'); ?></a>
						<a class="a-cast-add-minus" href="#"><?php echo elgg_view_icon('thumbs-o-up'); ?></a>
						<a class="a-cast-add-minus" href="#"><?php echo elgg_view_icon('bookmark-o'); ?></a>
					</div>
				</div>
				<div class="user-icon">
					<?php
					$icon = elgg_view_entity_icon($room, 'large', array(
						'use_hover' => false,
						'use_link' => false,
						'img_class' => 'photo u-photo',
						));
					echo $icon;
					?>
				</div>
				<div class="reserve-button" data-toggle="modal" data-target="#check_out" data-whatever="@mdo">Reserve Room</div>
			</div>
			<div class="col-xs-8">
				<div class="profile-details-container">
					<div class="profile-details">
						<?= elgg_view('rentals/profile/top_level_info', array('entity' => $room)); ?>
					</div>

					<div class="user-stats">
						<div class="pointing-view">
							<div class="anchor-view">
								<label class="anchor-view-icon">
									<?php echo elgg_view_icon('anchor'); ?>
								</label>
								<span class="pointing-text">42</span>
								<span class="pointing-text-tell">Service reputation</span>
							</div>
						</div>

						<div class="pointing-view">
							<div class="anchor-view">
								<label class="anchor-view-icon">
									<?php echo elgg_view_icon('thumbs-o-up'); ?>
								</label>
								<span class="pointing-text">4,232</span>
							</div>
						</div>

						<div class="pointing-view">
							<div class="anchor-view">
								<label class="anchor-view-icon">
									<?php echo elgg_view_icon('check-square-o'); ?>
								</label>
								<span class="pointing-text-tell">Mark to view later</span>
							</div>
						</div>

						<div class="pointing-view">
							<div class="anchor-view">
								<label class="anchor-view-icon">
									<?php echo elgg_view_icon('bookmark-o'); ?>
								</label>
								<span class="pointing-text-tell">&nbsp;Marked by </span>
								<span class="pointing-text">4,232</span>
								<span class="pointing-text-tell"> other interested people</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div>
	<div class="content-title">
		<span class="upload-icon-tab"><?php echo elgg_view_icon('copy'); ?></span> Room Details
	</div>
	<div class="room-details-profile-wrapper">
		<?php echo elgg_view('rentals/profile/details', array('entity' => $room)); ?>
	</div>
</div>

<div>
	<div class="content-title">
		<span class="upload-icon-tab"><?php echo elgg_view_icon('cloud-upload'); ?></span> 
		<?php echo (empty($requests)) ? "Reservation requests" : 'The room has been awarded to :'; ?>
	</div>
	<div class="reservation-requests-container">
		<?php

		// get widget settings

		if (empty($requests)) {
			$container_guid = $room -> guid;
			$db_prefix = elgg_get_config('dbprefix');

			$requests = elgg_get_entities_from_relationship(array(
				'type' => 'user',
				'relationship' => 'reservation_request',
				'relationship_guid' => $container_guid,
				'inverse_relationship' => true,
				'limit' => 0,
				));

			$content = elgg_view('campus_rooms/reservation_requests', array(
				'requests' => $requests,
				'entity' => $room,
				));
		} else {
			$content = elgg_view('campus_rooms/room_occupier', array(
				'requests' => $requests,
				'entity' => $room,
				));
		}

		echo $content;

		?>
	</div>
</div>

<div>
	<div class="content-title">
		<span class="upload-icon-tab"><?php echo elgg_view_icon('cloud-upload'); ?></span> Room photos
	</div>
	<div class="pics-profile-wrapper">
		<?php

		$container_guid = $room -> guid;
		$db_prefix = elgg_get_config('dbprefix');

		$image_html = elgg_get_entities(array(
			'type' => 'object',
			'subtype' => 'image',
			'joins' => array("join {$db_prefix}entities u on e.container_guid = u.guid"),
			'wheres' => array("e.container_guid = {$container_guid}"),
			'order_by' => "e.time_created desc",
			'limit' => 6,
			));

		$content_array = array(
			'entities' => $image_html,
			'default_picture' => $image_html[0],
			);

		echo elgg_view('albums/list', $content_array);

		?>
	</div>
	<div class="clearfix"></div>
</div>

<?php

$rooms_owned = elgg_get_entities([
	'type' => 'object',
	'subtype' => 'rentals',
	'owner_guid' => $room_owner_guid,

    // enable owner preloading
	'preload_owners' => true,
	]);

$total_rooms = (sizeof($rooms_owned) > 9) ? 'View other ' . (sizeof($rooms_owned) - 9) . ' Rooms published' : sizeof($rooms_owned) . ' Rooms published';

$rooms_owned = elgg_get_entities([
	'type' => 'object',
	'subtype' => 'rentals',
	'owner_guid' => $room_owner_guid,
	'limit' => 9,

    // enable owner preloading
	'preload_owners' => true,
	]);

$content_array = array(
	'entities' => $rooms_owned,
	);

$view_more_rooms = <<<HTML
&nbsp;&nbsp;&nbsp;<span class="upload-icon-tab"><?php echo elgg_view_icon('chevron-right'); ?> {$total_rooms} &nbsp;&nbsp;</span>
HTML;

?>

<div class="content-title">
	<span class="upload-icon-tab"><?php echo elgg_view_icon('cloud-upload'); ?></span>
	<?php echo ' Other rooms by ' . $owner_names . $view_more_rooms; ?>	
</div>
<div class="pics-profile-wrapper">
	<?php echo elgg_view('rentals/other_rooms_owned/other_rooms_owned_list', $content_array); ?>
</div>

<div class="modal fade" id="check_out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="check-out-tell">
					<p>
						You have to pay for the room to reserve it for yourself. The room will no longer be available to others after payment has been made to the room owner.
					</p>
					<p>
						The owner will not be able to list it for other prospective tenants.
					</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<?= $reservation_button; ?>
			</div>
			<?php echo $messages; ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#check_out').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('.modal-body input').val(recipient)
	})
</script>