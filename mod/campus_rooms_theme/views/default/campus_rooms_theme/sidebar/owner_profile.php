<style type="text/css">

	/** views/default/campus_room_theme/owner_profile **/

	.user-icon-container {
		background-color: #FFF;
		margin: 2px;
	}

	.set-site-menues-container {
		margin-top: -34px;
		border-right: 1px solid #dff0d8;
		width: 155px;
		position: fixed;
		z-index: 555;
	}

	.set-site-menues-wrapper {
		margin-top: 44px;
		border-top: 1px solid #dff0d8;
		border-bottom: 1px solid #dff0d8;
		border-left: 4px solid #dff0d8;
	}

	.set-my-site-menues {
		font-size: 90%;
		color: #444;
		font-weight: bold;
		background-color: #F7F7F7;
		border-bottom: 1px solid #dff0d8;
	}

	.personal-site-menues {
		font-size: 90%;
		padding: 7px 4px 12px 4px;
		max-width: 154px;
		width: 100%;
	}

	.personal-menu-item-header-icon {
		color: #444;
		font-size: 140%;
		padding: 7px 9px 2px 12px;
		max-width: 154px;
	}

	.personal-menu-item-header-txt {
		color: #444;
		font-size: 100%;
		font-weight: 500;
	}

	.personal-menu-item-icon {
		font-size: 120%;
		padding: 0 3px;
	}

	.personal-menu-item {
		font-size: 100% !important;
		padding: 5px 4px 2px 4px;
		min-width: 32px;
	}

</style>

<?php

$user = elgg_get_logged_in_user_entity();
$user_icon = elgg_view_entity_icon($user, 'large', array('use_hover' => false));

$default_icon = <<<FFF
<div class="user-icon-wrapper">
	<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
</div>
FFF;

?>

<div class="user-icon-container">
	<?php
	if (isset($user_icon)) {
		echo $user_icon;
	} else {
		echo $default_icon;
	}

	?>
</div>

<div class="set-my-site-menues">
	<label class="personal-menu-item-header-icon"><?php echo elgg_view_icon('angle-double-right'); ?></label>
	<span class="personal-menu-item-header-txt">My Links</span>
</div>
<div class="personal-site-menues">
	<label class="personal-menu-item-icon">
		<?= elgg_view_icon('envelope-o'); ?>
	</label>
	<span class="personal-menu-item site-mail-menu" data-placement="right">
		Mail
	</span>
	<br />
	<a href="<?= elgg_get_site_url(); ?>notifications">
		<label class="personal-menu-item-icon"><?php echo elgg_view_icon('fire'); ?></label>
		<span class="personal-menu-item">&nbsp;Notifications</span>
	</a>
	<br />
	<a href="#">
		<label class="personal-menu-item-icon"><?php echo elgg_view_icon('group'); ?></label>
		<span class="personal-menu-item">Networks</span>
	</a>
	<br />
	<a href="#">
		<label class="personal-menu-item-icon"><?php echo elgg_view_icon('institution'); ?></label>
		<span class="personal-menu-item">My areas</span>
	</a>
	<br />
	<a href="#">
		<label class="personal-menu-item-icon"><?php echo elgg_view_icon('mail-forward'); ?></label>
		<span class="personal-menu-item">Recomendations</span>
	</a>
	<br />
	<a href="#" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
		<label class="personal-menu-item-icon"><?php echo elgg_view_icon('flash'); ?></label>
		<span class="personal-menu-item">&nbsp;&nbsp;Feeds</span>
	</a>
</div>