<style type="text/css">

	.input-group-addon {
		font-weight: 400;
		line-height: 1 !important;
		text-align: center;
		border: 1px solid #ccc;
	}
</style>

<?php

$vars['class'] = (array) elgg_extract('class', $vars, []);
$vars['class'][] = 'form-control';

$defaults = array(
	'value' => '',
	'disabled' => false,
	'type' => 'text',
	);

$vars = array_merge($defaults, $vars);

$input_tetxfield =  elgg_format_element('input', $vars);

$sql = <<<INPUT
<div class="input-group input-group-sm">
	<span class="input-group-addon" id="basic-addon1">{$vars['label']}</span>
	{$input_tetxfield}
</div>
INPUT;

echo $sql;

?>