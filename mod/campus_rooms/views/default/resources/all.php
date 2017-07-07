<?php
/**
* List all
*/

$guid = elgg_extract('guid', $vars);
$rentals = get_entity($guid);
$full = elgg_extract('full_view', $vars, FALSE);

elgg_push_breadcrumb(elgg_echo('rentals'));

elgg_register_title_button();

$owner = elgg_get_logged_in_user_entity();
if (!$owner) {
	forward('', '404');
}


// category is passed from page handler
$title = elgg_echo("rooms:my_rental_listings");
elgg_push_breadcrumb(elgg_echo('rooms:my_rental_listings'), 'Rev');
elgg_push_breadcrumb($title);

$page_owner = elgg_get_page_owner_entity();

// List Reservations
$content_array = array(
	'type' => 'object',
	'subtype' => 'rentals',
	'full_view' => false,
    'item_view' => 'rentals/all',
	'limit' => 12,
	);

if (!elgg_is_admin_user($owner->guid)) {
	$content_array['container_guid'] = $owner->guid;
}

$content = elgg_list_entities($content_array);


if (!$content) {
	$content = elgg_echo("rooms:my_rental_listings_non");
}
$params['content'] = $content;
$params['sidebar'] = $sidebar;

$body = elgg_view_layout('content', $params);
echo elgg_view_page($title, $body);