<style type="text/css">

	.file-full-view-frame {
		margin-left: -7px;
	}
	
	.pics-profile-wrapper > a > img {
		max-width: 648px !important;
		width: 100% !important;
	}

</style>

<?php
$images = elgg_extract('entities', $vars, FALSE);
$default_picture = elgg_extract('default_picture', $vars, FALSE);

echo elgg_view_entity_list($images, [
	'item_view' => 'albums/item_view',
	'no_results' => 'No images to show',
	]);

$default_picture = elgg_view_entity_icon($default_picture, 'large');
$default_picture = <<<HTML
<div class="pics-profile-wrapper">
	{$default_picture}
</div>
HTML;
?>

<div class="file-full-view-frame"><?= $default_picture; ?></div>