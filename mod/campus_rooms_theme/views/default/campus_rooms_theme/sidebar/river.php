<style type="text/css">
	
	/* River sidebar view */

	.BAGplaces {
		max-width: 330px;
	}

	.river-items-options {
		margin-top: -14px;
	}

	.BAGplaces-label {
		font-size: 90%;
		font-weight: bold;
		padding: 4px 4px 2px 4px;
		margin: -17px 0 0 0;
		max-width: 334px;
		width: 100%;
		float: right;
		background-color: #F7F7F7;
		border: 1px solid #dff0d8;
		border-right: none;
		border-left: none;
		position: fixed;
		z-index: 550;
	}

	.BAGplaces-content {
		padding-top: 58px;
		margin-top: -28px;
		border: 1px solid #dff0d8;
		border-top: none;
		min-width: 334px;
		width: 100%;
		min-height: 565px;
		height: 100%;
		border-radius: 0;
	}

	.elgg-body-river-add-on {
		font-size: 95%;
	}

	.elgg-module-aside .elgg-head {
		font-weight: 500;
		border-bottom: 1px solid #dff0d8;
		margin-bottom: 5px;
		padding-bottom: 0 !important;
	}

	.container-left-right{width:100%;}
	.left{float:left;width: 60%;}
	.right{float:right;width: 40%;}
	.center{margin:0 auto;width:100px;}

</style>

<?php

$river_options = array(
	'pagination' => false,
	'limit' => 22
	);
$river_sidebar_output = elgg_list_river($river_options);

$river_sidebar_html = <<<_HTML
<div class="elgg-module-aside">
	<div class="elgg-head">Other recent items</div>
	<div>{$river_sidebar_output}</div>
</div>
_HTML;

?>

<div class="BAGplaces">
	<div class="BAGplaces-label">
		<?php 
		echo elgg_view_icon('angle-double-right'); 
		echo elgg_view_icon('angle-double-right'); 
		echo '&nbsp;&nbsp;';
		echo elgg_view_icon('caret-right');
		echo elgg_view_icon('caret-right');
		echo '&nbsp;&nbsp;';
		echo '<a>Recent items</a>';
		echo '&nbsp;&nbsp;';
		echo elgg_view_icon('caret-right');
		?>
	</div>

	<div class="BAGplaces-content">
		<div class="profile-river">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-1">
						<div class="river-items-options">
							<?php echo elgg_view_icon('level-down') . ' ' . elgg_view_icon('level-up'); ?>
						</div>
					</div>
					<div class="col-xs-11">
						<div class="river-flows">
							<?php

							$tweetcount = elgg_get_plugin_setting('tweetcount', 'river_addon');

							$subtype = 'tweet';

							echo "<div class=\"elgg-module elgg-module-aside\">";
							echo "<div class=\"container-left-right elgg-head\">";
							echo "<div class=\"left\">" . elgg_echo('ADs') . "</div>";
							echo "<div class=\"right\"><a>" . elgg_view_icon('feed') . " Create an AD</a></div>";
							echo "</div>";
							echo "<div class='elgg-body-river-add-on'>";			
							echo "<div class='tickerclass'>";
							echo "<ul>";
							for($id = 1; $id <= $tweetcount; $id++) {
								echo "<li>";
								echo elgg_echo("river_addon:$subtype:$id");
								echo "</li>";
							}
							echo "</ul>";
							echo "</div>";
							echo "</div>";
							echo "</div>";

							?>
						</div>
						<!-- Comments -->
						<div class="river-items-block"><?= $river_sidebar_html; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){	
		var sudoSlider = $(".tickerclass").sudoSlider({
			speed: 1000, 
			prevNext: false,
			fade: false,
			vertical:true,
			continuous:true,
			auto:true,
			pause: 10000
		});
	});
</script>