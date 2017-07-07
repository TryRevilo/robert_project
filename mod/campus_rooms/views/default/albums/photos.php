<style type="text/css">
	
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
		margin: 5px 0;
	}

	.tidypics-gallery-widget > li {
		width: 79px !important;
		margin: 3px;
		margin-top: 0 !important;
		margin-left: 0 !important;
	}

</style>
<?php

// get widget settings

$container_guid = elgg_extract('container_guid', $vars);
$db_prefix = elgg_get_config('dbprefix');

$image_html = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'image',
	'joins' => array("join {$db_prefix}entities u on e.container_guid = u.guid"),
	'wheres' => array("e.container_guid = {$container_guid}"),
	'order_by' => "e.time_created desc",
	'limit' => 7,
	'full_view' => false,
	'list_type_toggle' => false,
	'list_type' => 'gallery',
	'pagination' => false,
	'gallery_class' => 'tidypics-gallery-widget',
	));

echo $image_html;

?>