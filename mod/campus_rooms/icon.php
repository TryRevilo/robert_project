<?php
/**
 * Icon display
 *
 * @package ElggGroups
 */

if (!isset($page)) {
	die('This file cannot be called directly.');
}

$rentals_guid = get_input('rentals_guid');

/* @var ElggEntity $rentals */
$rentals = get_entity($rentals_guid);

// If is the same ETag, content didn't changed.
$etag = $rentals->icontime . $rentals_guid;
if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == "\"$etag\"") {
	header("HTTP/1.1 304 Not Modified");
	exit;
}

$size = strtolower(get_input('size'));
if (!in_array($size, array('large', 'medium', 'small', 'tiny', 'master', 'topbar')))
	$size = "medium";

$success = false;

$filehandler = new ElggFile();
$filehandler->owner_guid = $rentals->owner_guid;
$filehandler->setFilename("campus_rooms/" . $rentals->guid . $size . ".jpg");

$success = false;
if ($filehandler->open("read")) {
	if ($contents = $filehandler->read($filehandler->getSize())) {
		$success = true;
	}
}

if (!$success) {
	$contents = elgg_view("groups/default{$size}.gif");
	header("Content-type: image/gif");
} else {
	header("Content-type: image/jpeg");
}

header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', strtotime("+10 days")), true);
header("Pragma: public");
header("Cache-Control: public");
header("Content-Length: " . strlen($contents));
header("ETag: \"$etag\"");
echo $contents;
