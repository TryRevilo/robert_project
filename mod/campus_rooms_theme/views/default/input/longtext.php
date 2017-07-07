<?php

$vars['class'] = (array) elgg_extract('class', $vars, []);
$vars['class'][] = 'elgg-input-longtext';

$defaults = array(
	'value' => '',
	'rows' => '2',
	'cols' => '50',
	'id' => 'elgg-input-' . rand(), //@todo make this more robust
	);

$vars = array_merge($defaults, $vars);

$value = htmlspecialchars($vars['value'], ENT_QUOTES, 'UTF-8');
unset($vars['value']);

$auto_increment_textarea = elgg_format_element('textarea', $vars, $value);


$wrapper = <<<WRAPPER
<div id="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="long-text-label">
				{$vars['label']}
			</div>
		</div>
		<div class="panel-footer">{$auto_increment_textarea}</div>
	</div>
</div>
WRAPPER;

echo $wrapper;

?>

<script>
	// auto adjust the height of
	$('#container').on( 'keydown', 'textarea', function (e){
		$(this).css('height', 'auto' );
		$(this).height( this.scrollHeight );
	});
	$( 'textarea' ).keydown();
</script>

<style>

	.elgg-input-longtext {
		overflow-y: hidden; /* prevents scroll bar flash */
		padding-top: 1.1em; /* prevents text jump on Enter keypress */
	}

	.text-area-label {
		font-size: 17px;
		font-weight: bold;
		text-align: left;

	}

	.long-text-label {
		font-size: 90%;
		font-weight: bold;
		color: #444;
		padding: 5px 12px;
		margin-left: -15px;
		border-left: 1px #dff0d8 solid;
	}

	.panel-footer {
		padding: 5px 10px;
		border-color: #dff0d8 !important;
		border-left: 1px #dff0d8 solid;
	}

</style>