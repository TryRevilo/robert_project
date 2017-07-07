<style type="text/css">

	/**views/default/page/layouts/one_sidebar **/

	.fixed-menu-filter {
		padding-top: 12px;
		top: 100px !important;
		width: 100%;
		background-color: #FFF;
		position: fixed;
		z-index: 550;
		background-color: #FFF;
	}

	.panel {
		margin-bottom: 20px;
		background-color: #fff;
		border: 1px solid #dff0d8;
		border-radius: 0 !important;
		-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
		box-shadow: 0 1px 1px rgba(0,0,0,.05);
	}

	.page-wrapper {
		margin-top: 22px;
		margin-left: -32px !important;
	}

	.right-wrapper {
		position: relative;
		padding: 0px !important;
		margin-top: -117px;
	}

	.right-widgets-stats {
		margin-top: 135px;
		max-width: 374px;
		min-height: 455px;
		width: 100%;
		position: fixed;
		border-left: 1px #dff0d8 solid;
	}

	tbody {
		font-size: 90% !important;
	}

	.h1, .h2, .h3, h1, h2, h3 {
		margin-top: 4px !important;
		margin-bottom: 10px;
	}

	.panel-body {
		padding: 0 15px 0 15px !important;
	}

	.mtm {
		margin-left: 12px;
	}

	.panel {
		border-left: none !important;
	}

	.panel-heading {
		padding: 10px 15px;
		border-bottom: 1px solid #dff0d8;
		border-radius: 0 !important
	}

	.panel-default>.panel-heading {
		border-color: #dff0d8 !important;
	}

	.label {
		border-radius: 0 !important;
	}

</style>


<?php

$class = 'elgg-layout elgg-layout-one-column clearfix';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="<?php echo $class; ?>">
				<div class="elgg-body elgg-main">
					<?php
					echo elgg_extract('nav', $vars, elgg_view('navigation/breadcrumbs'));

					echo elgg_view('page/layouts/elements/header', $vars);

					echo $vars['content'];

					// @deprecated 1.8
					if (isset($vars['area1'])) {
						echo $vars['area1'];
					}
					?>
				</div>
			</div>
		</div>
		<div class="col-md-4"><?php echo elgg_view('campus_rooms_theme/sidebar/river'); ?></div>
	</div>
</div>