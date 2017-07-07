<?php

// get the form inputs
$title = get_input('title');
$room_number_desc = get_input('room_number_desc');
$description = get_input('description');
$room_location = get_input('room_location');
$room_price = get_input('room_price');
$tags = string_to_tag_array(get_input('tags'));

// create a new campus_room object
$campus_room = new ElggObject();
$campus_room->subtype = "rentals";
$campus_room->title = $title;
$campus_room->room_location = $room_location;
$campus_room->room_price = $room_price;
$campus_room->room_number_desc = $room_number_desc;
$campus_room->description = $description;

// for now make all campus_room posts public
$campus_room->access_id = ACCESS_PUBLIC;

// owner is logged in user
$campus_room->owner_guid = elgg_get_logged_in_user_guid();

// save tags as metadata
$campus_room->tags = $tags;

// save to database and get id of the new campus_room
$campus_room_guid = $campus_room->save();

$has_uploaded_icon = (!empty($_FILES['icon']['type']) && substr_count($_FILES['icon']['type'], 'image/'));

if ($has_uploaded_icon) {

    $icon_sizes = elgg_get_config('icon_sizes');

    $prefix = "campus_rooms/" . $campus_room->guid;

    $filehandler = new ElggFile();
    $filehandler->container_guid = $campus_room->guid;
    $filehandler->setFilename($prefix . ".jpg");
    $filehandler->open("write");
    $filehandler->write(get_uploaded_file('icon'));
    $filehandler->close();
    $filename = $filehandler->getFilenameOnFilestore();

    $sizes = array('tiny', 'small', 'medium', 'large', 'master');

    $thumbs = array();
    foreach ($sizes as $size) {
        $thumbs[$size] = get_resized_image_from_existing_file(
            $filename,
            $icon_sizes[$size]['w'],
            $icon_sizes[$size]['h'],
            $icon_sizes[$size]['square']
            );
    }

    if ($thumbs['tiny']) { // just checking if resize successful
        $thumb = new ElggFile();
        $thumb->owner_guid = $campus_room->owner_guid;
        $thumb->setMimeType('image/jpeg');

        foreach ($sizes as $size) {
            $thumb->setFilename("{$prefix}{$size}.jpg");
            $thumb->open("write");
            $thumb->write($thumbs[$size]);
            $thumb->close();
        }

        $campus_room->icontime = time();
    }
}


// Aupload images

elgg_load_library('campus_rooms:upload');

set_input('tidypics_action_name', 'tidypics_photo_upload');

$guid = $campus_room_guid;
$album = get_entity($guid);
if (!$album) {
    register_error(elgg_echo('tidypics:baduploadform'));
    forward(REFERER);
}

// post limit exceeded
if (count($_FILES) == 0) {
    trigger_error('Tidypics warning: user exceeded post limit on image upload', E_USER_WARNING);
    register_error(elgg_echo('tidypics:exceedpostlimit'));
    forward(REFERER);
}

// test to make sure at least 1 image was selected by user
$num_images = 0;
foreach($_FILES['images']['name'] as $name) {
    if (!empty($name)) {
        $num_images++;
    }
}
if ($num_images == 0) {
    // have user try again
    register_error(elgg_echo('tidypics:noimages'));
    forward(REFERER);
}

// create the image object for each upload
$uploaded_images = array();
$not_uploaded = array();
$error_msgs = array();
foreach ($_FILES['images']['name'] as $index => $value) {
    $data = array();
    foreach ($_FILES['images'] as $key => $values) {
        $data[$key] = $values[$index];
    }

    if (empty($data['name'])) {
        continue;
    }

    $name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8', false);

    $mime = tp_upload_get_mimetype($name);

    $image = new CampusRoomsImage();
    $image->title = $name;
    $image->container_guid = $album->getGUID();
    $image->setMimeType($mime);
    $image->access_id = $album->access_id;

    try {
        $result = $image->save($data);
    } catch (Exception $e) {
        $image->delete();
        $result = false;
        array_push($not_uploaded, $name);
        array_push($error_msgs, $e->getMessage());
    }
}

if (count($not_uploaded) > 0) {
    if (count($uploaded_images) > 0) {
        $error = sprintf(elgg_echo("tidypics:partialuploadfailure"), count($not_uploaded), count($not_uploaded) + count($uploaded_images))  . '<br />';
    } else {
        $error = elgg_echo("tidypics:completeuploadfailure") . '<br />';
    }

    $num_failures = count($not_uploaded);
    for ($i = 0; $i < $num_failures; $i++) {
        $error .= "{$not_uploaded[$i]}: {$error_msgs[$i]} <br />";
    }
    register_error($error);

    if (count($uploaded_images) == 0) {
        //upload failed, so forward to previous page
        forward(REFERER);
    } else {
        // some images did upload so we fall through
    }
} else {
    system_message(elgg_echo('tidypics:upl_success'));
}

if ($campus_room_guid) {
    elgg_create_river_item(array(
        'view' => 'river/object/rentals/add_room',
        'action_type' => 'create',
        'subject_guid' => elgg_get_logged_in_user_guid(),
        'object_guid' => $campus_room_guid,
        ));
} else {
    // failed to save file object - nothing we can do about this
    $error = elgg_echo("Not into river");
    register_error($error);
}

// Finish Upload Images

// if the room was saved, we want to display it
// otherwise, we want to register an error and forward back to the form
if ($campus_room) {
    system_message("Your Room was added onto the system >>> " . $campus_room_guid);
    forward('/rooms/room/' . $campus_room_guid);
} else {
    register_error("The Room could not be saved");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}