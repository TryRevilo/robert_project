<style type="text/css">

	/** Customs **/

	.more-details {
		padding: 10px;
		padding-left: 0;
	}


	/** Picture upload preview **/

	.preview-area {
		max-width: 100%;
	}

	.image-preview {
		position: relative;
		display: table;
		margin: 8px;
		max-width: 160px !important;
		border: 1px solid #ddd;
		box-shadow: 1px 1px 5px 0 #a2958a;
		padding: 6px;
	}

	.file-preview-frame {
		text-align: center;
		vertical-align: middle;
		position: relative;
		display: table;
		margin: 8px;
		border: 1px solid #ddd;
		box-shadow: 1px 1px 5px 0 #a2958a;
		padding: 6px;
		float: left;
		overflow: hidden;
		max-width: 160px !important;
	}

	.file-footer-caption {
		max-width: 160px !important;
	}

	.file-drop-zone {
		border: 1px dashed #dff0d8;
		border-radius: 0;
		text-align: center;
		vertical-align: middle;
		margin: 0 !important;
		margin-right: 0 !important;
		padding: 5px;
		padding-left: 12px;
	}

	.file-preview-frame:not(.file-preview-error):hover {
		box-shadow: 3px 3px 5px 0 #333;
	}

	.modal-content {
		border: none !important;
		margin: 0 !important;
		padding: 0 !important;
		border-radius: 0 !important;
		display: block;
		overflow: auto;
	}

	.pics-wrapper {
		margin-top: 12px;
		margin-right: -10px;
		margin-bottom: -10px;
		background-color: #FFF
		display: flex;
		flex-direction: column;
		min-height: 2vh;
		display: none;
		z-index: 655;
	}

	.room-number {
		margin: 8px auto;
	}

	#description {
		font-size: 15px !important;
		padding-left: 25px; 
		border-top: none !important;
		margin-right: -5px !important;
		border-right: none !important;
		border-left: none !important;
	}

	#description:focus {
		background-color: #FFF !important;
	}

	.textarea-char-count {
		font-size: 90%;
		color: #666;
		padding: 4px 10px;
		margin-left: 12px;
		margin-right: 12px;
		border: 1px solid #dff0d8;
		border-top: none;
		width: 170px;
	}

	#collapseDescriptionRoom {
		padding-top: 10px;
	}

	.mandatory-input {
		font-size: 90%;
		color: #42B548;
		padding-top: 10px;
		padding-left: 12px;
	}

	.btn-group-xs>.btn, .btn-xs {
		padding: 5px;
		font-size: 100% !important;
		line-height: 1.5;
		margin: 0 auto !important;
		border-radius: 3px;
	}


</style>

<div>

	<ul class="tabs nav nav-pills">
		<li class="tab-link current inline-block-pad-center-form" data-tab="tab-1">
			<a>
				<?php echo elgg_view_icon('long-arrow-right'); ?> &nbsp; Profile
			</a>
		</li>
	</ul>

	<?php echo elgg_view("input/file", array("name" => "icon", 'label' => ' Room icon')); ?>

	<p>
		<?= elgg_view('input/text', ['name' => 'title', 'id' => 'title', 'label' => 'Name of place']); ?>
	</p>

	<p>
		<?php echo elgg_view('form_items/price_location'); ?>
	</p>

	<div class="room-number">
		<p>
			<span class="glyphicon glyphicon-align-left" aria-hidden="true">
				Single <input type="radio" name="radio1" id="r2" value="Nothing">  
			</span>

			<span class="glyphicon glyphicon-align-left" aria-hidden="true">
				Double <input type="radio" name="radio1" id="r3" value="Nothing">  
			</span>

			<span class="glyphicon glyphicon-align-left" aria-hidden="true">
				Other <input type="radio" name="radio1" id="r1" value="Show">
			</span>

		</p>

		<div class="text">
			<p>Describe the rooms
				<input type="text" name="room_number_desc" id="room_number_desc" maxlength="250">
			</p>
		</div>			
	</div>

	<div class="panel panel-warning">
		<div class="more-details">
			<?php echo elgg_view_icon('fire'); ?> &nbsp; 
			<a role="button" data-toggle="collapse" href="#collapseDescriptionRoom" aria-expanded="false" aria-controls="collapseDescriptionRoom">
				More details
			</a>

			<div class="collapse" id="collapseDescriptionRoom">
				<textarea name="description" id="description" class="fa fa-search status form-control animated tatus form-control custom-control" placeholder='&#xf044;' maxlength="255" style="resize:none"></textarea>

				<div class="textarea-char-count"></div>

				<p>
					<?= elgg_view('input/tags', ['name' => 'tags', 'id' => 'tags', 'label' => 'tags']); ?>
				</p>
			</div>
		</div>
	</div>

	<div class="panel panel-warning">
		<div class="more-details">
			<?php echo elgg_view_icon('camera'); ?> &nbsp; 
			<a role="button" class="pics-wrapperanchor" data-toggle="collapse" href="#room-pictures" aria-expanded="false" aria-controls="room-pictures">
				Room pictures
			</a>

			<div class="pics-wrapper">
				<div class="modal-content">
					<?php echo elgg_view("input/multi_file", array("name" => "images[]", 'label' => ' Select pictures')); ?>
					<div class="file-drop-zone"></div>
				</div>
			</div>
		</div>
	</div>

	<p>
		<?= elgg_view('input/submit', ['value' => elgg_echo('save')]); ?>
	</p>
</div>

<!-- container -->

<script type="text/javascript">
	$(document).ready(function () {
		$(".text").hide();
		$("#r1").click(function () {
			$(".text").show();
		});
		$("#r2").click(function () {
			$(".text").hide();
		});
		$("#r3").click(function () {
			$(".text").hide();
		});
	});
</script>

<!-- Pics toggle -->

<script>
	$( ".pics-wrapperanchor" ).click(function() {
		$( ".pics-wrapper" ).slideToggle( "slow" );
	});
</script>

<script type="text/javascript">

	var imageId = 0;
	var fileUrls = [];

	var inputLocalFont = document.getElementById("multi-file");
	inputLocalFont.addEventListener("change", previewImages, false);

	function previewImages(){
		var fileList = this.files;
		var objectUrl;

		var anyWindow = window.URL || window.webkitURL;

		for(var i = 0; i < fileList.length; i++){
			imageId++;
			// var filName = fileList[i].name();
			
			if(jQuery.inArray(fileList[i], fileUrls) == -1) {
				objectUrl = anyWindow.createObjectURL(fileList[i]);
				fileUrls.push(fileList[i]);

				var imageSize = bytesToSize(fileList[i].size);

				var img = '<img class="image-preview" src="' + objectUrl + '" />';

				var html = `
				<div class="file-preview-frame">
					${img}
					<div class="file-thumbnail-footer">
						<div class="file-footer-caption" title="easter_egg_hunt_wallpaper_1920x1080 _ Copy.jpg">easter_egg_hunt_wallpaper_1920x1080 _ Copy.jpg
							<br>
							<samp>(${imageSize}) remove${imageId}</samp>
						</div>
						<div class="file-thumb-progress hide"><div class="progress">
							<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;">
								0%
							</div>
						</div></div> <div class="file-actions">
						<div class="file-footer-buttons">
							<button type="button" class="kv-file-remove remove${i} btn btn-xs btn-default" title="Remove file">
								<i class="glyphicon glyphicon-trash text-danger"></i>
							</button>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
			`;

			$('.file-drop-zone').append(html);
			window.URL.revokeObjectURL(fileList[i]);
		}
	}

	function bytesToSize(bytes) {
		var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
		if (bytes == 0) return '0 Byte';
		var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
		return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	};
}

</script>

<script>
	$(function(){
		$('.normal').autosize();
		$('.animated').autosize({append: "\n"});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		var text_max = 255;
		$('.textarea-char-count').html(text_max + ' characters remaining');

		$('.status').keyup(function() {
			var text_length = $('#description').val().length;
			var text_remaining = text_max - text_length;

			$('.textarea-char-count').html(text_remaining + ' characters remaining');
		});

	});
</script>