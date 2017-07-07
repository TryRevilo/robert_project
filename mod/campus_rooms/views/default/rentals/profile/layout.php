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

	.status-update {
		margin-top: -68px;
		margin-left: -8px;
		padding-top: 68px;
		width: 678px;
		min-height: 61px;
		background-color: #FFF;
		position: fixed;
		position: relative;
		display: block;
		position: fixed;
		z-index: 9999;
	}

	#textarea {
		font-size: 15px !important;
		padding-left: 25px; 
		border-top: none !important;
		
		margin-right: -5px !important;
		border-right: none !important;
		border-left: none !important;
	}

	#textarea:focus {
		background-color: #FFF !important;
	}

	.update-options {
		padding-top: 2px;
		padding-bottom: 22px;
	}

	.upload-media-update {
		padding: 4px 10px;
		margin-left: 12px;
		margin-right: 12px;
		border: 1px solid #dff0d8;
		border-top: none;
	}

	.textarea-char-count {
		font-size: 90%;
		color: #666;
		padding: 4px 10px;
		margin-left: 12px;
		margin-right: 12px;
		border: 1px solid #dff0d8;
		border-top: none;
	}

	.post-media-update {
		font: 11px;
		padding: 4px 10px;
		margin-left: 12px;
		margin-right: 12px;
		border: 1px solid #dff0d8;
		border-top: none;
	}

	.info-content-wrapper {
		margin-top: 90px;
	}

	.info-content {
		margin-top: 5px;
		margin-left: 12px;
		padding-top: 12px;
	}

	.user-icon {
		width: 160px;
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
		margin-top: 16px;
		margin-left: 22px;
	}

	.profile-details {
		font-size: 90%;
		margin-top: 4px;
		margin-left: 7px;
	}

	.profile-river {
		margin: 12px;
		margin-top: 0;
	}

	.river-flows {
		margin-top: -12px;
		margin-left: 5px;
	}

	.upload-icon-tab {
		font-size: 15px;
		padding: 4px 4px;
		border: 1px solid #dff0d8;
		border-bottom: none;
	}

	.content-title {
		font-size: 90%;
		padding-bottom: 1px;
		margin-top: 22px;
		margin-left: 15px;
		border-bottom: 1px #dff0d8 solid;
	}

	.pics-profile-wrapper {
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

	.elgg-module-tidypics-album, .elgg-module-tidypics-image {
		width: 98% !important;
		text-align: left;
		margin: 5px;
	}

	.tidypics-gallery-widget > li {
		width: 87px !important;
		margin: 3px;
	}

	.profile-options-container {
		margin-top: 42px;
	}

	.user-stats {
		border: 1px solid #dff0d8;
		padding: 5px;
		border-right: none;
		background-color: #F7F7F7;
	}

	.anchor-view {
		margin-top: 2px;
	}

	.anchor-view-icon {
		font-size: 120%;
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

	.pointer-options {
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

	.pointer-options .fa-plus-square-o {
		color: #31DE0D !important;
	}

	.pointer-options .fa-minus-square-o {
		color: #FF4F90 !important;
	}
	

</style>

<?php 

$user = elgg_get_page_owner_entity();

?>

<div class="status-update">
	<textarea id="textarea" class="fa fa-search status form-control animated tatus form-control custom-control" placeholder='&#xf044; Update your status' maxlength="255" style="resize:none"></textarea>

	<div class="update-options">
		<a href="#">
			<span class="upload-media-update">
				<?php echo elgg_view_icon('upload'); ?>
			</span>
		</a>
		<span class="textarea-char-count"></span>
		<a href="#">
			<span class="post-media-update">
				<?php echo elgg_view_icon('quote-left') . ' Post update ' . elgg_view_icon('quote-right'); ?>
			</span>
		</a>
	</div>
</div>

<div class="clearfix"> </div>

<div class="info-content-wrapper">
	<div class="info-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-1">
					<div class="profile-options-container">
						<p>
							<a href=""><span class="edit-profile-options"><?php echo elgg_view_icon('crop') . ' Edit'; ?></span></a>
						</p>
						<p>
							<a href=""><span class="edit-profile-options"><?php echo elgg_view_icon('camera') . ' Icon'; ?></span></a>
						</p>
						<p>
							<a href=""><span class="edit-profile-options"><?php echo elgg_view_icon('envelope') . ' Mail'; ?></span></a>
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
						</div>
					</div>
					<div class="user-icon">
						<?php
						$icon = elgg_view_entity_icon($user, 'large', array(
							'use_hover' => false,
							'use_link' => false,
							'img_class' => 'photo u-photo',
							));
						echo $icon;
						?>
					</div>
				</div>
				<div class="col-xs-8">
					<div class="profile-details-container">
						<div class="profile-details">
							<?php echo elgg_view('profile/details'); ?>
						</div>

						<div class="user-stats">
							<div class="pointing-view">
								<div class="anchor-view">
									<label class="anchor-view-icon"><?php echo elgg_view_icon('anchor'); ?></label>
									<span class="pointing-text">42</span>
									<span class="pointing-text-tell">This reflects the landlord's past service reputation</span>
								</div>
							</div>

							<div class="pointing-view">
								<div class="anchor-view">
									<label class="anchor-view-icon"><?php echo elgg_view_icon('thumbs-o-up'); ?></label>
									<span class="pointing-text">4,232</span>
								</div>
							</div>

							<div class="pointing-view">
								<div class="anchor-view">
									<label class="anchor-view-icon"><?php echo elgg_view_icon('check-square-o'); ?></label>
									<span class="pointing-text-tell">Mark to view later</span>
								</div>
							</div>

							<div class="pointing-view">
								<div class="anchor-view">
									<label class="anchor-view-icon"><?php echo elgg_view_icon('bookmark-o'); ?></label>
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
</div>

<div class="content-title">
	<a>
		<span class="upload-icon-tab"><?php echo elgg_view_icon('cloud-upload'); ?></span>
		Upload pictures
	</a>
</div>
<div class="pics-profile-wrapper">
	<?php

	$container_guid = elgg_get_page_owner_guid();
	$db_prefix = elgg_get_config('dbprefix');

	$image_html = elgg_list_entities(array(
		'type' => 'object',
		'subtype' => 'image',
		'joins' => array("join {$db_prefix}entities u on e.container_guid = u.guid"),
		'wheres' => array("u.container_guid = {$container_guid}"),
		'order_by' => "e.time_created desc",
		'limit' => 28,
		'full_view' => false,
		'list_type_toggle' => false,
		'list_type' => 'gallery',
		'pagination' => false,
		'gallery_class' => 'tidypics-gallery-widget',
		));

	echo $image_html;

	?>
</div>
<script>
	$(function(){
		$('.normal').autosize();
		$('.animated').autosize({append: "\n"});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		var text_max = 255;
		$('.textarea-char-count').html(text_max + ' characters remaining');

		$('.status').keyup(function() {
			var text_length = $('#textarea').val().length;
			var text_remaining = text_max - text_length;

			$('.textarea-char-count').html(text_remaining + ' characters remaining');
		});

	});
</script>