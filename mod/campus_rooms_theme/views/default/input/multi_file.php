<?php

if (!empty($vars['value'])) {
	echo elgg_echo('fileexists') . "<br />";
}

$vars['class'] = (array) elgg_extract('class', $vars, []);
$vars['class'][] = 'filestyle';
$icon_label =  $vars['label'];

$defaults = array(
	'disabled' => false,
	'type' => 'file',
	'multiple' => 'multiple',
	'id' => 'multi-file',
);

$vars = array_merge($defaults, $vars);

$input_tetxfield =  elgg_format_element('input', $vars);

$sql = <<<SQL
<div class="input-group input-group-sm">
	{$input_tetxfield}
</div>
SQL;

echo $sql;

?>

<script type="text/javascript">
var icon_label = '<?php echo $icon_label; ?>';
	$(":file").filestyle({buttonText: (icon_label), size: "sm", buttonBefore: false, placeholder: "No file selected"});
</script>