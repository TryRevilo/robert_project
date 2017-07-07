<?php

function rev_theme_init_css() {

	// css overrides

	$css_overrides = 'mod/campus_rooms_theme/vendors/css/rev_css_overrides.css';
	elgg_register_css('css_overrides', $css_overrides);
	elgg_load_css('css_overrides');

	$normalize = 'mod/campus_rooms_theme/vendors/normalize.css';
	elgg_register_css('normalize', $normalize);
	elgg_load_css('normalize');

	$css_base = 'mod/campus_rooms_theme/vendors/twitter_bootstrap/css';

	$bootstrap = $css_base . '/bootstrap.min.css';
	elgg_register_css('bootstrap', $bootstrap);
	elgg_load_css('bootstrap');

	$bootstrap_theme =$css_base . '/bootstrap-theme.min.css.css';
	elgg_register_css('bootstrap-theme', $bootstrap_theme);
	elgg_load_css('bootstrap-theme');

  	// JS

	$file_style_base = 'mod/campus_rooms_theme/vendors/bootstrap-filestyle-1.2.1/src/bootstrap-filestyle.min.js';
	elgg_register_js('file_style', $file_style_base);
	elgg_load_js('file_style');

	$autosize_master = 'mod/campus_rooms_theme/vendors/autosize-master/dist/autosize.js';
	elgg_register_js('autosize_master', $autosize_master);
	elgg_load_js('autosize_master');

	// Bootstrap

	$bootstrap_js_base = 'mod/campus_rooms_theme/vendors/twitter_bootstrap/js';
	
	$bootstrap = $bootstrap_js_base. '/bootstrap.min.js';
	elgg_register_js('bootstrap', $bootstrap);
	elgg_load_js('bootstrap');

	// js textcomplete

	$textcomplete = 'mod/campus_rooms_theme/vendors/JQuery/dist/jquery.textcomplete.min.js';
	elgg_register_js('textcomplete', $textcomplete);
	elgg_load_js('textcomplete');

	// js Auto resize Text Area

	$auto_resize_text_area = 'mod/campus_rooms_theme/vendors/JQuery/auto_resize_text_area.js';
	elgg_register_js('auto_resize_text_area', $auto_resize_text_area);
	elgg_load_js('auto_resize_text_area');

}

?>