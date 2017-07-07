<style type="text/css">
	
	.reservation-requests-wrapper {
		margin-top: 7px;
		max-width: 620px;
	}

	.margin-left-requests {
		margin-left: 10px;
	}

	.names-pull-left {
		margin-left: -5px;
	}

	.no-check-reserves {
		font-size: 90%;
		margin-top: 4px;
		margin-left: 35px;
	}

</style>

<?php
/**
 * A group's member requests
 *
 * @uses $vars['entity']   ElggGroup
 * @uses $vars['requests'] Array of ElggUsers
 */



if (!empty($vars['requests']) && is_array($vars['requests'])) {
	foreach ($vars['requests'] as $user) {
		$room_guid = $vars['entity']->guid;
		$room = get_entity($room_guid);
		$user_icon = elgg_view_entity_icon($user, 'small', array('use_hover' => 'true'));
		$room_name = $room -> title;
		$room_icon = elgg_view_entity_icon($room, 'small', array(
			'use_hover' => false,
			'use_link' => false,
			'img_class' => 'photo u-photo',
			));

		$user_title = elgg_view('output/url', array(
			'href' => $user->getURL(),
			'text' => $user->name,
			'is_trusted' => true,
			'class' => 'margin-left-requests names-pull-left',
			));

		$url = "action/reservations/accept_reservation?user_guid={$user->guid}&group_guid={$vars['entity']->guid}";
		$url = elgg_add_action_tokens_to_url($url);
		$accept_button = elgg_view('output/url', array(
			'href' => $url,
			'text' => elgg_echo('accept'),
			'class' => 'btn btn-primary margin-left-requests',
			'is_trusted' => true,
			));

		$url = 'action/groups/killrequest?user_guid=' . $user->guid . '&group_guid=' . $vars['entity']->guid;
		$reject_button = elgg_view('output/url', array(
			'href' => $url,
			'confirm' => elgg_echo('groups:joinrequest:remove:check'),
			'text' => elgg_echo('delete'),
			'class' => 'btn btn-danger',
			));

		echo <<<HTML
		<div class="reservation-requests-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-1">$user_icon</div>
					<div class="col-md-2">$user_title</div>
					<div class="col-md-1">$room_icon</div>
					<div class="col-md-7">$room_name</div>
					<div class="col-md-1">$accept_button</div>
				</div>
			</div>
		</div>
HTML;
	}
} else {
	echo '<p class="no-check-reserves">' . elgg_echo('There are no reservation requests to display currently') . '</p>';
}