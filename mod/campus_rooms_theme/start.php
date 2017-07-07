<?php

elgg_register_event_handler('init', 'system', 'campus_rooms_theme_init');

function campus_rooms_theme_init() {

	elgg_register_library('campus_rooms_css_overrides', __DIR__ . '/lib/campus_rooms_css_overrides.php');
	elgg_load_library('campus_rooms_css_overrides');
	campus_rooms_css_overrides_init();

	elgg_register_library('campus_rooms_theme_css', __DIR__ . '/lib/css_js.php');
	elgg_load_library('campus_rooms_theme_css');
	rev_theme_init_css();
}