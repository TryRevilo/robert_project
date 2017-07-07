<style type="text/css">

	.room-full-view-frame {
		padding: 10px;
		margin-bottom: 22px;
		margin-bottom: 22px;
		background-color: #F7F7F7;
		border: 1px solid #dff0d8;
	}

	.inline-room-icon > a > img {
		height: auto;
	}

	.view-room-button {
		font-size: 100%;
		font-weight: 500;
		color: #FFF;
		cursor: pointer;
		text-align: center;
		padding: 4px 10px;
		margin-left: -2px;
		border: 1px solid #dff0d8;
		background-color: #74B52C;
		max-width: 203px;
	}

	.inline-content-title {
		font-size: 100%;
		font-weight: 500;
		padding-bottom: 1px;
		margin-top: 22px;
		border-bottom: 1px #dff0d8 solid;
	}

	.inline-room-details-profile-wrapper {
		padding-top: 12px;
	}

	.inline-user-stats {
		padding: 5px;
		padding-bottom: 10px;
		margin-top: 2px;
		min-height: 123px;
		border: 1px solid #dff0d8;
		border-right: none;
		background-color: #F7F7F7;
	}

</style>

<?php

$room_guid = get_input('guid');
$room = get_entity($room_guid);
$icon = elgg_view_entity_icon($room, 'large', array(
	'use_hover' => false,
	'use_link' => false,
	'img_class' => 'photo u-photo',
	));

	?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-4">
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
				<div class="inline-room-icon">
					<?= $icon; ?>
				</div>
				<a href="<?php echo elgg_get_site_url() . "rooms/room/" . $room_guid; ?>">
					<div class="view-room-button" data-toggle="modal" data-target="#check_out" data-whatever="@mdo">View Room Details</div>
				</a>
			</div>

			<div class="col-xs-8">
				<div class="profile-details">
					<?php echo elgg_view('rentals/profile/top_level_info', array('entity' => $room)); ?>
				</div>

				<div class="inline-user-stats">
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

	<div>
		<div class="inline-content-title">
			<span class="upload-icon-tab"><?php echo elgg_view_icon('copy'); ?></span> Room Details
		</div>
		<div class="inline-room-details-profile-wrapper">
			<?php echo elgg_view('rentals/profile/details', array('entity' => $room)); ?>
		</div>
	</div>