<style type="text/css">

	.hidden-multi {
		height: 0 !important;
		width: 0 !important;
		display: none !important;
		overflow: hidden !important;
	}

</style>

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
	'class' => 'hidden-multi',
	'id' => 'hidden-multi',
);

$vars = array_merge($defaults, $vars);

$input_tetxfield =  elgg_format_element('input', $vars);

$sql = <<<SQL
<span class="hidden-multi">{$input_tetxfield}</span>
SQL;

echo $sql;

?>

<script type="text/javascript">
var icon_label = '<?php echo $icon_label; ?>';
	$(":file").filestyle({buttonText: (icon_label), size: "sm", buttonBefore: false, placeholder: "No file selected"});
</script>