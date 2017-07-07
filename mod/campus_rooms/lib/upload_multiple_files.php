<?php

function upload_multiple_files($owner_guid) {

// create a new campus_room object
    $album = new ElggObject();
    $album->subtype = "album";

// for now make all campus_room posts public
    $album->access_id = ACCESS_PUBLIC;

// owner is logged in user
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
}

?>