<?php

if (!elgg_is_xhr()) {
	register_error('Sorry, Ajax only!');
	forward();
}

$arg1 = (int)get_input('arg1');
$arg2 = (int)get_input('arg2');

system_message('We did it!');

echo json_encode([
	'sum' => $arg1 + $arg2,
	'product' => $arg1 * $arg2,
	]);