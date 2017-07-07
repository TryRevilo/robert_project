<?php

function campus_rooms_css_overrides_init() {

	// css overrides

	$default = 'mod/campus_rooms_theme/vendors/overrides/css/default.css';
	elgg_register_css('default', $default);
	elgg_load_css('default');
	
}

?>