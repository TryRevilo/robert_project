<?php
/**
 * Form for adding and editing comments
 *
 * @package Elgg
 * @subpackage FxTheme
 * @uses ElggEntity  $vars['entity']       The entity being commented
 * @uses ElggComment $vars['comment']      The comment being edited
 * @uses bool        $vars['inline']       Show a single line version of the form?
 * @uses bool        $vars['is_edit_page'] Is this form on its own page?
 */

if (!elgg_is_logged_in()) {
	return;
}

$entity = elgg_extract('entity', $vars);
/* @var ElggEntity $entity */

$comment = elgg_extract('comment', $vars);
/* @var ElggComment $comment */

$inline = elgg_extract('inline', $vars, false);
$is_edit_page = elgg_extract('is_edit_page', $vars, false);
$elguid = $entity->guid;
$entity_guid_input = '';
if ($entity) {
	$entity_guid_input = elgg_view('input/hidden', array(
		'name' => 'entity_guid',
		'value' => $entity->guid,
	));
}

$comment_text = '';
$comment_guid_input = '';
if ($comment && $comment->canEdit()) {
	$entity_guid_input = elgg_view('input/hidden', array(
		'name' => 'comment_guid',
		'value' => $comment->guid,
	));
	$comment_label  = elgg_echo("generic_comments:edit");
	$submit_input = elgg_view('input/submit', array('value' => elgg_echo('save')));
	$comment_text = $comment->description;
} else {
	$comment_label  = elgg_echo("generic_comments:add");
	$submit_input = elgg_view('input/submit', array('value' => elgg_echo('comment')));
}

$cancel_button = '';
if ($comment) {
	$cancel_button = elgg_view('input/button', array(
		'value' => elgg_echo('cancel'),
		'class' => 'elgg-button-cancel mlm',
		'href' => $entity ? $entity->getURL() : '#',
	));
}

if ($inline) {
	$comment_input = elgg_view('input/plaintext', array(
		'name' => 'generic_comment',
		'value' => $comment_text,
		'id' => "com-$elguid",
		'rows' => '1',
	));

	echo $comment_input . $entity_guid_input . $comment_guid_input . $submit_input;
} else {

	$comment_input = elgg_view('input/plaintext', array(
		'name' => 'generic_comment',
		'value' => $comment_text,
		'id' => "com-$elguid",
		'rows' => '1',
	));

	$is_edit_page_input = elgg_view('input/hidden', array(
		'name' => 'is_edit_page',
		'value' => (int)$is_edit_page,
	));
	echo <<<FORM
	<div id="comments-add-$elguid">
	<div>
	<label>$comment_label</label>
	$comment_input
</div>
<div class="elgg-foot">
	$is_edit_page_input
	$comment_guid_input
	$entity_guid_input
	$submit_input $cancel_button
</div></div>
FORM;
}
?>
<script>
var observeter;
if (window.attachEvent) {
    observeter = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observeter = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
$('#com-<?php echo $vars['entity']->getGUID(); ?>').click(function(event) {
$( '#comments-add-<?php echo $vars['entity']->getGUID();?>' ).addClass('gran');
$('#comments-add-<?php echo $vars['entity']->getGUID();?>').removeClass('peq');
var text = document.getElementById('com-<?php echo $vars['entity']->getGUID(); ?>');
function resize () {
        text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
		}
    function delayedResizer () {
        window.setTimeout(resize, 0);
    }
    observeter(text, 'change',  resize);
    observeter(text, 'cut',     delayedResizer);
    observeter(text, 'paste',   delayedResizer);
    observeter(text, 'drop',    delayedResizer);
    observeter(text, 'keydown', delayedResizer);    
    resize();
});
$(document).click(function(event) { 
    if(!$(event.target).closest('#comments-add-<?php echo $vars['entity']->getGUID();?>').length) {
        
            $('#comments-add-<?php echo $vars['entity']->getGUID();?>').removeClass("gran");
			$('#comments-add-<?php echo $vars['entity']->getGUID();?>').addClass("peq");        
    }        
})
$( '#comments-add-<?php echo $vars['entity']->getGUID();?> .elgg-button-submit' ).click(function() {
 			$( '#comments-add-<?php echo $vars['entity']->getGUID();?> .elgg-button-submit' ).addClass("enviandi");
			$( '#com-<?php echo $vars['entity']->getGUID();?>' ).addClass("enviandini");
			$('#comments-add-<?php echo $vars['entity']->getGUID();?>').append('<div id=\'sustitutin\' class=\'elgg-button\'><?php echo elgg_echo('comment'); ?></div>');           
        $( 'div#sustitutin' ).animate({
    opacity: 0
  }, 1000, function() {
  $('#com-<?php echo $vars['entity']->getGUID();?>').val('');
  $( '#com-<?php echo $vars['entity']->getGUID();?>' ).removeClass("enviandini");
  $('#comments-add-<?php echo $vars['entity']->getGUID();?>').removeClass("gran");    
	            $( '#com-<?php echo $vars['entity']->getGUID(); ?>' ).animate({
               height: "32px"
               }, 250, function() {    	
	                $('div#sustitutin').remove();
	                 $( '#comments-add-<?php echo $vars['entity']->getGUID();?> .elgg-button-submit' ).removeClass("enviandi");
               });
  });
});  
</script>

