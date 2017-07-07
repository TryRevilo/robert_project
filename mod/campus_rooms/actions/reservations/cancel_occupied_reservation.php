<?php
/**
 * Add users to a group
 *
 * @package ElggGroups
 */
$logged_in_user = elgg_get_logged_in_user_entity();

$user_guid = get_input('user_guid');
if (!is_array($user_guid)) {
	$user_guid = array($user_guid);
}
$group_guid = get_input('group_guid');
$group = get_entity($group_guid);
/* @var ElggGroup $group */

$errors = array();
if (sizeof($user_guid)) {
	foreach ($user_guid as $u_guid) {
		$user = get_user($u_guid);

		if ($user && $group->canEdit()) {
			if (check_entity_relationship($user->guid, 'room_occupied', $group->guid)) {
				system_message(elgg_echo("Reservation canceled {$user->name}"));

				// if an invitation is still pending clear it up, we don't need it
				remove_entity_relationship($user->guid, 'room_occupied', $group->guid);
			}
			else {
				$errors[] = elgg_echo('Err ', array($user->name));
			}
		}
	}
}

if ($errors) {
	foreach ($errors as $error) {
		register_error($error);
	}
}

forward(REFERER);
