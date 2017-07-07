<style type="text/css">

	/** Customs **/

	.more-details {
		padding: 10px;
		padding-left: 0;
	}


	/** Picture upload preview **/

	.preview-area {
		max-width: 100%;
	}

	.image-preview {
		position: relative;
		display: table;
		margin: 8px;
		max-width: 100% !important;
		border: 1px solid #ddd;
		box-shadow: 1px 1px 5px 0 #a2958a;
		padding: 6px;
	}

	.file-footer-caption {
		max-width: 120px !important;
	}

	.file-preview-frame {
		text-align: center;
		vertical-align: middle;
		position: relative;
		display: table;
		margin: 8px 0 !important;
		border: 1px solid #ddd;
		border-right: none !important;
		border-left: none !important;
		box-shadow: 1px 1px 5px 0 #a2958a;
		padding: 2px;
		float: left;
		overflow: hidden;
		max-width: 111px !important;
	}

	.file-preview-frame:not(.file-preview-error):hover {
		box-shadow: 3px 3px 5px 0 #333;
	}

	.modal-content {
		border: none !important;
		margin: 0 !important;
		padding: 0 !important;
		border-radius: 0 !important;
		display: block;
		overflow: auto;
	}

	.btn-group-xs>.btn, .btn-xs {
		padding: 5px;
		font-size: 100% !important;
		line-height: 1.5;
		margin: 0 auto !important;
		border-radius: 3px;
	}

	.room-status {
		font-size: 90%;
		padding: 4px;
		margin-bottom: 20px;
		overflow: hidden;
		background-color: #f5f5f5;
		border-radius: 0 !important;
		-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
		box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	}

</style>

<?php
elgg_require_js('js/campus_rooms/other_rooms_owned');
$room = elgg_extract('entity', $vars);
$guid = $room -> getGUID();

$title = $room -> title;
$img = elgg_view_entity_icon($room, 'small');
?>

<div class="file-preview-frame">
	<div class="image-preview"><?= $img ?></div>
	<div class="file-thumbnail-footer">
		<div class="file-actions">
			<div class="file-footer-buttons">
				<button type="button" class="kv-room-zoom btn btn-xs btn-default" title="View Details" data-guid=<?= $guid ?>>
					<i class="glyphicon glyphicon-zoom-in"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="file-thumb-progress">
		<div class="room-status">
			Available
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#inline-room-details-view').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('.modal-body input').val(recipient)
	})
</script>