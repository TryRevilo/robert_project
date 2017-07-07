<?php

/**
 * Join a user to a group, add river event, clean-up invitations
 *
 * @param ElggGroup $group
 * @param ElggUser  $user
 * @return bool
 */
function groups_join_group($group, $user) {

  // access ignore so user can be added to access collection of invisible group
  $ia = elgg_set_ignore_access(TRUE);
  $result = $group->join($user);
  elgg_set_ignore_access($ia);

  if ($result) {
    // flush user's access info so the collection is added
    get_access_list($user->guid, 0, true);

    // Remove any invite or join request flags
    remove_entity_relationship($group->guid, 'invited', $user->guid);
    remove_entity_relationship($user->guid, 'membership_request', $group->guid);

    elgg_create_river_item(array(
      'view' => 'river/relationship/member/create',
      'action_type' => 'join',
      'subject_guid' => $user->guid,
      'object_guid' => $group->guid,
      ));

    return true;
  }

  return false;
}