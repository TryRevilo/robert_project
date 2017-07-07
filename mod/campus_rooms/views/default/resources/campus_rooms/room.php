<?php

$guid = elgg_extract('guid', $vars);

$room = get_entity($guid);

$title = $room -> title;
$content = elgg_view('rentals/room', array('entity' => $room));

$params = array(
	'content' => $content,
	'title' => $room->name,
);

$body = elgg_view_layout('one_sidebar', $params);

echo elgg_view_page($title, $body);