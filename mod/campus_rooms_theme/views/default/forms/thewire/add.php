<?php
/**
 * Wire add form body
 *
 * @uses $vars['post']
 */

elgg_load_js('elgg.thewire');

$post = elgg_extract('post', $vars);
$char_limit = (int)elgg_get_plugin_setting('limit', 'thewire');

$text = elgg_echo('post');
if ($post) {
	$text = elgg_echo('reply');
}
$chars_left = elgg_echo('thewire:charleft');

$parent_input = '';
if ($post) {
	$parent_input = elgg_view('input/hidden', array(
		'name' => 'parent_guid',
		'value' => $post->guid,
	));
}

$count_down = "<span>$char_limit</span> $chars_left";
$num_lines = 2;
if ($char_limit == 0) {
	$num_lines = 3;
	$count_down = '';
} else if ($char_limit > 140) {
	$num_lines = 3;
}

$post_input = elgg_view('input/plaintext', array(
	'name' => 'body',
	'class' => 'mtm',
	'id' => 'thewire-textarea',
	'rows' => $num_lines,
	'data-max-length' => $char_limit,
));

$submit_button = elgg_view('input/submit', array(
	'value' => $text,
	'id' => 'thewire-submit-button',
));

echo <<<HTML
	$post_input
<div id="thewire-characters-remaining">
	$count_down
</div>
<div class="elgg-foot mts">
	$parent_input
	$submit_button
</div>
HTML;
?>
<script>
    $('#thewire-submit-button').click(function() { 
        $('#thewire-submit-button').each(function() {
            if ($(this).attr('disabled')) {
            }
            else {	
			$( '#thewire-submit-button' ).addClass("enviando");
			$('.elgg-form-thewire-add .elgg-foot').prepend('<div id=\'sustituto\' class=\'elgg-button\' ><?php echo $text; ?></div>');
			$( '#sustituto' ).animate({
    opacity: 0
  }, 1000, function() {
    $('.elgg-form-thewire-add').removeClass("grande");
	
$( '#thewire-textarea' ).animate({
    height: "30px"
  }, 250, function() {
     
$("#thewire-submit-button").attr('disabled', 'disabled');
		$("#thewire-submit-button").addClass('elgg-state-disabled'); 
	$( '#thewire-submit-button' ).removeClass("enviando");
	$('#sustituto').remove();
	
  });
		
  });
			
            }
        });
    });

$(document).click(function(event) { 
    if(!$(event.target).closest('.elgg-form-thewire-add').length) {
        
            $('.elgg-form-thewire-add').addClass("pequena");      
    }        
})
$(document).click(function(event) { 
    if(!$(event.target).closest('.elgg-form-thewire-add').length) {
        
            $('.elgg-form-thewire-add').removeClass("grande");
		        
    }        
})
jQuery( "#thewire-textarea" ).click(function() {
  jQuery( ".elgg-form-thewire-add" ).addClass("grande");
  
});
jQuery( "#thewire-textarea" ).click(function() {

  jQuery( ".elgg-form-thewire-add" ).removeClass("pequena");
});
var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}
jQuery(document).ready(function(){ 
    var text = document.getElementById('thewire-textarea');
    function resize () {
        text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
    }
    /* 0-timeout to get the already changed text */
    function delayedResize () {
        window.setTimeout(resize, 0);
    }
    observe(text, 'change',  resize);
    observe(text, 'cut',     delayedResize);
    observe(text, 'paste',   delayedResize);
    observe(text, 'drop',    delayedResize);
    observe(text, 'keydown', delayedResize);   
    resize();
});
</script>
