<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">New message</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="recipient-name" class="control-label">Recipient:</label>
						<input type="text" class="form-control" id="recipient-name">
					</div>
					<div class="form-group">
						<label for="message-text" class="control-label">Message:</label>
						<textarea class="form-control" id="message-text"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Send message</button>
			</div>
			<?php echo $messages; ?>
		</div>
	</div>
</div>

<!-- Hidden Items -->
<div class="mail-popover-content hidden">
	<div class="mail-popover-content-container">
		<a href="<?php echo elgg_get_site_url(); ?>messages/inbox">
			<label class="personal-menu-item-icon"><?php echo elgg_view_icon('mail-reply'); ?></label>
			<span class="personal-menu-item">InBox</span>
		</a>
		<br />
		<a href="<?php echo elgg_get_site_url(); ?>messages/sent">
			<label class="personal-menu-item-icon"><?php echo elgg_view_icon('mail-forward'); ?></label>
			<span class="personal-menu-item">Out Box</span>
		</a>
		<br />
		<a href="<?php echo elgg_get_site_url(); ?>messages/compose">
			<label class="personal-menu-item-icon"><?php echo elgg_view_icon('edit'); ?></label>
			<span class="personal-menu-item">Compose Mail</span>
		</a>
		<br />
	</div>
</div>

<div id="mail-popover-title" class="hidden">
	<label class="personal-menu-item-header-txt">
		<?= elgg_view_icon('envelope-o'); ?>&nbsp;&nbsp;&nbsp;&nbsp;<b>Mail</b>
	</label>
</div>

<script type="text/javascript">
	$('#exampleModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  modal.find('.modal-title').text('New message to ' + recipient)
	  modal.find('.modal-body input').val(recipient)
	})

	// Enables popover #1
	$("[data-toggle=popover]").popover();

	// Enables popover #2
	$(".site-mail-menu").popover({
		html : true, 
		content: function() {
			return $(".mail-popover-content").html();
		},
		title: function() {
			return $("#mail-popover-title").html();
		}
	});
</script>