<?php

if (elgg_get_context() == 'admin') {
	if (get_input('handler') != 'admin') {
		elgg_deprecated_notice("admin plugins should route through 'admin'.", 1.8);
	}
	_elgg_admin_add_plugin_settings_menu();
	elgg_unregister_css('elgg');
	echo elgg_view('page/admin', $vars);
	return true;
}

// render content before head so that JavaScript and CSS can be loaded. See #4032

$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));

$content = elgg_view('page/elements/body', $vars);

$body .= elgg_view('page/elements/foot');

$head = elgg_view('page/elements/head', $vars['head']);

$params = array(
	'head' => $head,
	'body' => $body,
	);

if (isset($vars['body_attrs'])) {
	$params['body_attrs'] = $vars['body_attrs'];
}

echo elgg_view("page/elements/html", $params);


$site = elgg_get_site_entity();
$site_name = $site->name;
$custom_site_header = elgg_view('campus_rooms_theme/custom_site_nav_bar', ['site_name' => $site_name]);

$crambs = elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));
$th =  '&nbsp;&nbsp' . elgg_view_icon('th') . '&nbsp;&nbsp';

$crambs_list = <<<CRAMBS
<li role="presentation">
	{$th}
</li>
<li role="presentation">
	{$crambs}
</li>
<li role="presentation">
	{$th}
</li>
CRAMBS;

$params_all_rooms = array(
	'href' => elgg_get_site_url() . '/rooms/all',
	'text' => elgg_view_icon('hotel') . ' View All Rooms',
	'is_action' => true,
	'is_trusted' => true,
	'class' => 'all-rooms-gen',
	);

$all_rooms = elgg_view('output/url', $params_all_rooms);

?>

<div class="container">

	<?= $messages; ?>

	<!-- Rev custom Head start -->
	<div class="custom-head">
		<div class="bg-primary custom-site-header"><?= $custom_site_header; ?></div>
		<!-- End Rev custom crumbs -->
		<div class="row">
			<div class="fixed-menu-filter">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-10">
							<div class="filter-wrapper">
								<div class="filter-float-left filter-float-left-icon">
									<span><?= elgg_view_icon('angle-double-left'); ?></span>
									<span><?= elgg_view_icon('angle-double-right'); ?></span>
								</div>
								
								<div class="filter-float-left">
									<?php
									if (isset($vars['filter'])) {
										echo $vars['filter'];
									}
									
									echo elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));
									?>
								</div>

								<?= $all_rooms; ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Rev custom Head -->

	<!-- main content start-->
	<div class="cast-main-content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-2">
					<div class="set-site-menues-container">
						<div class="set-site-menues-wrapper">
							<div><?= elgg_view('campus_rooms_theme/sidebar/owner_profile'); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<div class="main-content main-content2 main-content2copy">
						<div class="page-wrapper">
							<div class="graphs">
								<?= $content; ?>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= elgg_view('campus_rooms_theme/patches/default'); ?>