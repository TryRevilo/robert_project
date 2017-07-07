<?php

elgg_make_sticky_form('add_rooms');

// get the form inputs
$title = get_input('title');
$room_number_desc = get_input('room_number_desc');
$description = get_input('description');
$tags = string_to_tag_array(get_input('tags'));

// create a new campus_room object
$campus_room = new ElggObject();
$campus_room->subtype = "rentals";
$campus_room->title = $title;
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

// Save the room photos
// create a new campus_room object
$album = new ElggObject();
$album->subtype = "rental_album";

// for now make all campus_room posts public
$album->access_id = ACCESS_PUBLIC;

$owner_guid = $campus_room_guid;

$album->owner_guid = $owner_guid;

// save to database and get id of the new campus_room
$album_guid = $album->save();

$file_keys = array();
$file_keys = array_keys($_FILES['screenshot']['tmp_name']);

$file_keys = array();
if ($_FILES['screenshot']['tmp_name']) {
    $file_keys = array_keys($_FILES['screenshot']['tmp_name']);
    foreach ($_FILES['screenshot']['tmp_name'] as $key => $tmp_name) {
        $size = getimagesize($_FILES['screenshot']['tmp_name'][$key]);
    }
}

// Now see if we have a file icon
if ($file_keys) {
    $time = time();
    $invalid = 0;
    foreach ($file_keys as $key) {

        $prefix = "showcase/albums/".$time.$key;
        $img_orig = get_resized_image_from_existing_file($_FILES['screenshot']['tmp_name'][$key],2048,1536, false);
        $filehandler = new ElggFile();
        $filehandler->access_id = elgg_is_admin_logged_in() ? ACCESS_PUBLIC : ACCESS_PRIVATE;
        $filehandler->owner_guid = $album_guid;
        $filehandler->setFilename($prefix . ".jpg");
        $filehandler->open("write");
        $filehandler->write($img_orig);
        $filehandler->close();
        $filehandler->save();

        add_entity_relationship($filehandler->guid, 'screenshot', $showcase->guid);
        $thumbtiny = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),25,25, true);
        $thumbsmall = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),40,40, true);
        $thumbmedium = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),100,100, true);
        $thumblarge = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),200,200, false);
        $thumbmaster = get_resized_image_from_existing_file($filehandler->getFilenameOnFilestore(),700,400, false);
        if ($thumbtiny) {
            $thumb = new ElggFile();
            $thumb->owner_guid = $album_guid;
            $thumb->setMimeType('image/jpeg');

            $thumb->setFilename($prefix."tiny.jpg");
            $thumb->open("write");
            $thumb->write($thumbtiny);
            $thumb->close();
            $thumb->setFilename($prefix."small.jpg");
            $thumb->open("write");
            $thumb->write($thumbsmall);
            $thumb->close();
            $thumb->setFilename($prefix."medium.jpg");
            $thumb->open("write");
            $thumb->write($thumbmedium);
            $thumb->close();
            $thumb->setFilename($prefix."large.jpg");
            $thumb->open("write");
            $thumb->write($thumblarge);
            $thumb->close();

            $thumb->setFilename($prefix."master.jpg");
            $thumb->open("write");
            $thumb->write($thumbmaster);
            $thumb->close();
        }

        $filehandler->file_prefix = $prefix;

        if ($invalid) {
            system_message(elgg_echo('showcase:invalid:screenshot:size', array($invalid)));
        }
    }
}

// Room saved so clear sticky form
elgg_clear_sticky_form('add_rooms');

// if the room was saved, we want to display it
// otherwise, we want to register an error and forward back to the form
if ($campus_room) {
    system_message("Your Room was added onto the system");
    forward('/rooms/rentals');
} else {
    register_error("The Room could not be saved");
   forward(REFERER); // REFERER is a global variable that defines the previous page
}