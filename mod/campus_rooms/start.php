<?php

elgg_register_event_handler('init', 'system', 'campus_rooms_init');

// Ensure this runs after other plugins
elgg_register_event_handler('init', 'system', 'add_rooms_fields_setup', 10000);

function campus_rooms_init() {

  // Register libraries
  $base_dir = elgg_get_plugins_path() . 'campus_rooms/lib';
  elgg_register_library('campus_rooms:upload', "$base_dir/upload.php");

  elgg_register_library('campus_rooms_css_js', __DIR__ . '/lib/campus_rooms_css_js.php');
  elgg_load_library('campus_rooms_css_js');
  campus_rooms_init_css();
  
  elgg_register_library('upload_multiple_files', __DIR__ . '/lib/upload_multiple_files.php');
  elgg_register_library('campus_rooms', __DIR__ . '/lib/campus_rooms.php');

  // add a site navigation item
  $item = new ElggMenuItem('campus_rooms', elgg_echo('rooms:campus_rooms'), 'rooms/add_room');
  elgg_register_menu_item('site', $item);

  elgg_register_page_handler('rooms', 'campus_rooms_page_handler');

  elgg_register_action("campus_rooms/add_room", __DIR__ . "/actions/campus_rooms/add_room.php");
  elgg_register_action("campus_rooms/album", __DIR__ . "/actions/campus_rooms/album.php");

  elgg_register_action("do_math", __DIR__ . "/actions/do_math.php");
  
  $actions_base = __DIR__ . '/actions/reservations';
  elgg_register_action('reservations/request_reservation', "$actions_base/request_reservation.php");
  elgg_register_action('reservations/accept_reservation', "$actions_base/accept_reservation.php");
  elgg_register_action('reservations/cancel_occupied_reservation', "$actions_base/cancel_occupied_reservation.php");

  // Register for search.
  elgg_register_entity_type('object', 'rentals');
  elgg_register_entity_type('object', 'rental_album');

  // Register URL handlers for object
  elgg_register_plugin_hook_handler('entity:icon:url', 'object', 'rentals_set_icon_url');

  // Register an icon handler for rentals
  elgg_register_page_handler('groupicon', 'rentals_icon_handler');
  
  elgg_register_plugin_hook_handler('register', 'menu:ajax_menu', 'ajaxify_menu_handler');

  // registered with priority < 500 so other plugins can remove Request Reservation
  elgg_register_plugin_hook_handler('register', 'menu:reservation_menu', 'reservation_entity_menu_setup', 400);

  // Ajax views
  elgg_register_ajax_view('albums/inline_full_image_view');
  elgg_register_ajax_view('rentals/other_rooms_owned/inline_full_room_view');

}

function campus_rooms_page_handler($segments) {

  if (!isset($segments[0])) {
    $segments = array('rentals');
  }
  
  switch ($segments[0]) {
    case 'add':
    case 'add_room':
    echo elgg_view_resource('campus_rooms/add_room');
    break;

    case 'room':
    if (isset($segments[1])) {
      $resource_vars['guid'] = (int)$segments[1];
    }
    echo elgg_view_resource('campus_rooms/room', $resource_vars);
    break;

    case 'album':
    echo elgg_view_resource('campus_rooms/album');
    break;

    case 'all':
    echo elgg_view_resource('all');
    break;
    default:
    return false;
  }

  return true;
}

function add_rooms_fields_setup() {

  $profile_defaults = array(
    'description' => 'longtext',
    'briefdescription' => 'text',
    'interests' => 'tags',
    //'website' => 'url',
    );

  $profile_defaults = elgg_trigger_plugin_hook('profile:fields', 'campus_rooms', NULL, $profile_defaults);

  elgg_set_config('campus_rooms', $profile_defaults);

  // register any tag metadata names
  foreach ($profile_defaults as $name => $type) {
    if ($type == 'tags') {
      elgg_register_tag_metadata_name($name);

      // only shows up in search but why not just set this in en.php as doing it here
      // means you cannot override it in a plugin
      add_translation(get_current_language(), array("tag_names:$name" => elgg_echo("groups:$name")));
    }
  }
}

/**
 * Handle rentals icons.
 *
 * @param array $page
 * @return bool
 */
function rentals_icon_handler($page) {

  // The username should be the file we're getting
  if (isset($page[0])) {
    set_input('rentals_guid', $page[0]);
  }
  if (isset($page[1])) {
    set_input('size', $page[1]);
  }
  // Include the standard profile index
  include __DIR__ . "/icon.php";
  return true;
}


function rentals_set_icon_url($hook, $type, $url, $params) {
  /* @var ElggGroup $group */
  $group = $params['entity'];
  $size = $params['size'];

  $icontime = $group->icontime;
  // handle missing metadata (pre 1.7 installations)
  if (null === $icontime) {
    $file = new ElggFile();
    $file->owner_guid = $group->owner_guid;
    $file->setFilename("campus_rooms/" . $group->guid . "large.jpg");
    $icontime = $file->exists() ? time() : 0;
    create_metadata($group->guid, 'icontime', $icontime, 'integer', $group->owner_guid, ACCESS_PUBLIC);
  }
  if ($icontime) {
    // return thumbnail
    return "groupicon/$group->guid/$size/$icontime.jpg";
  }

  return elgg_get_simplecache_url("groups/default{$size}.gif");
}

function reservation_entity_menu_setup($hook, $type, $return, $params) {

  $entity_guid = $params['guid'];

    // Always register both. That makes it super easy to toggle with javascript
  $return[] = ElggMenuItem::factory(array(
    'name' => 'likes',
    'href' => elgg_add_action_tokens_to_url("/action/reservations/request_reservation?guid={$entity_guid}"),
    'text' => elgg_view_icon('thumbs-up'),
    'title' => elgg_echo('likes:likethis'),
    'priority' => 1000,
    ));

  return $return;
}