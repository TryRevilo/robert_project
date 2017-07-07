<style type="text/css">
	
	.pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
		z-index: 2;
		color: #23527c;
		background-color: #eee;
		border-color: #dff0d8 !important;
	}

	.pagination>li:first-child>a, .pagination>li:first-child>span {
		margin-left: 0;
		border-radius: 0 !important;
	}

	.pagination>li:last-child>a, .pagination>li:last-child>span {
		border-left: none !important;
		border-radius: 0 !important;
	}

	.cast-lists {
		margin-left: 50px;
	}

</style>

<?php

$nav = ($pagination) ? elgg_view('navigation/pagination', $vars) : '';

$nav_wrapper = <<<NAV
<div class"cast-lists">
	{$nav}
</div>
NAV;

$items = $vars['items'];
$count = elgg_extract('count', $vars);
$pagination = elgg_extract('pagination', $vars, true);
$position = elgg_extract('position', $vars, 'after');
$no_results = elgg_extract('no_results', $vars, '');

if (!$items && $no_results) {
	if ($no_results instanceof Closure) {
		echo $no_results();
		return;
	}
	echo "<p class='elgg-no-results'>$no_results</p>";
	return;
}

if (!is_array($items) || count($items) == 0) {
	return;
}

$list_classes = ['elgg-list'];
if (isset($vars['list_class'])) {
	$list_classes[] = $vars['list_class'];
}

$item_classes = ['elgg-item'];
if (isset($vars['item_class'])) {
	$item_classes[] = $vars['item_class'];
}

$list_items = '';
foreach ($items as $item) {
	$item_view = elgg_view_list_item($item, $vars);
	if (!$item_view) {
		continue;
	}

	$li_attrs = ['class' => $item_classes];

	if ($item instanceof \ElggEntity) {
		$guid = $item->getGUID();
		$type = $item->getType();
		$subtype = $item->getSubtype();

		$li_attrs['id'] = "elgg-$type-$guid";

		$li_attrs['class'][] = "elgg-item-$type";
		if ($subtype) {
			$li_attrs['class'][] = "elgg-item-$type-$subtype";
		}
	} else if (is_callable(array($item, 'getType'))) {
		$li_attrs['id'] = "item-{$item->getType()}-{$item->id}";
	}

	$list_items .= elgg_format_element('li', $li_attrs, $item_view);
}

if ($position == 'before' || $position == 'both') {
	echo $nav_wrapper;
}

echo elgg_format_element('ul', ['class' => $list_classes], $list_items);

if ($position == 'after' || $position == 'both') {
	echo $nav_wrapper;
}

?>