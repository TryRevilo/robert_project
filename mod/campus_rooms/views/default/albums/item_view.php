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

</style>

<?php
elgg_require_js('js/campus_rooms/inline_image_view');
$image = elgg_extract('entity', $vars);
$guid = $image -> getGUID();

$img = elgg_view_entity_icon($image, 'small'); 
?>

<div class="file-preview-frame">
	<div class="image-preview"><?= $img ?></div>
	<div class="file-thumbnail-footer">
		<div class="file-thumb-progress hide">
			<div class="progress">
				<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
					0%
				</div>
			</div>
		</div>
		<div class="file-actions">
			<div class="file-footer-buttons">
				<button type="button" class="kv-file-upload btn btn-xs btn-default" title="Upload file">
					<i class="glyphicon glyphicon-download text-info"></i>
				</button>
				<button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file">
					<i class="glyphicon glyphicon-trash text-danger"></i>
				</button>
				<button type="button" class="kv-file-zoom btn btn-xs btn-default" title="View Details" data-guid=<?= $guid ?>>
					<i class="glyphicon glyphicon-zoom-in"></i>
				</button>
			</div>
		</div>
	</div>
</div>