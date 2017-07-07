<?php

$vars['class'] = (array) elgg_extract('class', $vars, []);
$vars['class'][] = 'elgg-input-tags';

$defaults = array(
	'value' => '',
	'disabled' => false,
	'autocapitalize' => 'off',
	'type' => 'text'
	);

if (isset($vars['entity'])) {
	$defaults['value'] = $vars['entity']->tags;
	unset($vars['entity']);
}

$vars = array_merge($defaults, $vars);

if (is_array($vars['value'])) {
	$tags = array();

	foreach ($vars['value'] as $tag) {
		if (is_string($tag)) {
			$tags[] = $tag;
		} else {
			$tags[] = $tag->value;
		}
	}

	$vars['value'] = implode(", ", $tags);
}

$input_tetxfield =  elgg_format_element('input', $vars);

$sql = <<<INPUT
<div class="input-group input-group-sm">
	<span class="input-group-addon" id="basic-addon1">{$vars['label']}</span>
	{$input_tetxfield}
</div>
INPUT;

echo $sql;

?>