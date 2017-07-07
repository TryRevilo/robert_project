<style type="text/css">

	/**views/default/page/layouts/one_sidebar **/

	.container-fluid {
		padding-right: 0 !important;
		padding-left: 0 !important;
		margin-right: auto;
		margin-left: auto;
	}

	.panel {
		margin-bottom: 20px;
		background-color: #fff;
		border: 1px solid #dff0d8;
		border-radius: 0 !important;
		-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
		box-shadow: 0 1px 1px rgba(0,0,0,.05);
	}

	.right-wrapper {
		position: relative;
		padding: 0px !important;
		margin-top: -117px;
	}

	.right-widgets-stats {
		margin-top: 135px;
		max-width: 374px;
		min-height: 499px;
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

	.elgg-list > li {
		padding-right: 14px;
		margin-right: -1px;
		border-right: 1px solid #dff0d8;
		border-bottom: 1px solid #dff0d8;
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
	
	.elgg-photo {
		border: 1px solid #DCDCDC;
		padding: 5px;
		background-color: #FFF;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		max-width: 100% !important;
		height: auto;
	}

	.elgg-module-tidypics-album, .elgg-module-tidypics-image {
		width: 100% !important;
		text-align: left;
		margin: 3px;
	}

	.tidypics-gallery-widget > li {
		width: auto !important;
	}
	
	.elgg-photo {
		border: 1px solid #DCDCDC;
		padding: 5px;
		background-color: #FFF;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		max-width: 100% !important;
		height: auto;
	}

	.elgg-module-tidypics-album, .elgg-module-tidypics-image {
		width: 98% !important;
		text-align: left;
		margin: 3px;
	}

	.tidypics-gallery-widget > li {
		width: 87px !important;
		margin: 3px;
	}
	
</style>


<?php
$class = 'elgg-layout elgg-layout-one-sidebar clearfix';
if (isset($vars['class'])) {
	$class = "$class {$vars['class']}";
}

?>

<div class="<?php echo $class; ?>">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<div class="main-page-content" data-anijs="
				if: load, on: window, do: fadeIn animated, to: .elgg-layout-one-sidebar .elgg-main, before: $addClass visible, after: removeAnim;

				if: load, on: window, do: fadeIn animated, to: .elgg-layout-one-sidebar .elgg-sidebar, before: $addClass visible, after: removeAnim;
				if: scroll, on:window, do: bounceIn animated, to: .elgg-pagination, before: scrollReveal, after: removeAnim;
				if: scroll, on:window, do: bounceIn animated, to: .elg-main .elgg-item .elgg-avatar, before: scrollReveal, after: removeAnim;
				if: load, on:window, do: bounceIn animated, to: .elg-main .elgg-item .elgg-avatar, before: scrollReveal, after: removeAnim;
				if: scroll, on:window, do: bounceIn animated, to: .elgg-main .elgg-item .elgg-image, before: scrollReveal, after: removeAnim;
				if: load, on:window, do: bounceIn animated, to: .elgg-main .elgg-item .elgg-image, before: scrollReveal, after: removeAnim;

				">
				<?php

			// @todo deprecated so remove in Elgg 2.0
				if (isset($vars['area1'])) {
					echo $vars['area1'];
				}
				if (isset($vars['content'])) {
					echo $vars['content'];
				}
				?>
			</div>
		</div>
		<div class="col-md-4"><?php echo elgg_view('campus_rooms_theme/sidebar/river'); ?></div>
	</div>
</div>
</div>
