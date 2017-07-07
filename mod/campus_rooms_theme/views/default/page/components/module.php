<?php

$type = elgg_extract('type', $vars, false);
$title = elgg_extract('title', $vars, '');
$body = elgg_extract('body', $vars, '');
$footer = elgg_extract('footer', $vars, '');
$show_inner = elgg_extract('show_inner', $vars, false);

$attrs = [
	'id' => elgg_extract('id', $vars),
	'class' => (array) elgg_extract('class', $vars, []),
];

$attrs['class'][] = 'elgg-module';
if ($type) {
	$attrs['class'][] = "elgg-module-$type";
}

$body = elgg_format_element('div', ['class' => 'elgg-body'], $body);
if ($footer) {
	$footer = elgg_format_element('div', ['class' => 'elgg-foot'], $footer);
}

$contents = $body . $footer;
if ($show_inner) {
	$contents = elgg_format_element('div', ['class' => 'elgg-inner'], $contents);
}

echo elgg_format_element('div', $attrs, $contents);
