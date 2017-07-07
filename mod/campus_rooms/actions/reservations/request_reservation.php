<?php
/**
 * Join a room
 *
 * Three states:
 * open room so user joins
 * closed room so request sent to room owner
 * closed room with invite so user joins
 *
 * @package Elggrooms
 */

global $CONFIG;

$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$room_guid = get_input('room_guid');

$user = get_user($user_guid);

// access bypass for getting invisible room
$ia = elgg_set_ignore_access(true);
$room = get_entity($room_guid);
elgg_set_ignore_access($ia);

if ($user && ($room instanceof ElggObject)) {

	// join or request
	$join = false;
	
	if (check_entity_relationship($room->guid, 'invited', $user->guid)) {
		// user has invite to closed room
		$join = true;
	}

	if ($join) {
		if (groups_join_group($room, $user)) {
			system_message(elgg_echo("groups:joined"));
			forward($room->getURL());
		} else {
			register_error(elgg_echo("groups:cantjoin"));
		}
	} else {
		add_entity_relationship($user->guid, 'reservation_request', $room->guid);

		$owner = $room->getOwnerEntity();

		$url = "{$CONFIG->url}groups/requests/$group->guid";

		$subject = elgg_echo('groups:request:subject', array(
			$user->name,
			$room->name,
			), $owner->language);

		$body = elgg_echo('groups:request:body', array(
			$room->getOwnerEntity()->name,
			$user->name,
			$room->name,
			$user->getURL(),
			$url,
			), $owner->language);

		$params = [
		'action' => 'membership_request',
		'object' => $room,
		];
		
		// Notify room owner
		if (notify_user($owner->guid, $user->getGUID(), $subject, $body, $params)) {
			system_message(elgg_echo("groups:joinrequestmade"));
		} else {
			register_error(elgg_echo("groups:joinrequestnotmade"));
		}
	}
} else {
	register_error('Oh! No....');
}

forward(REFERER);
