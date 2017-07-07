require(['elgg/Ajax'], Ajax => {

	var ajax = new Ajax();

	$('.glyphicon-zoom-in').click(function(event) {

		$( '.full-image-view' ).css( "color", "red" ).append('<div>This Shows Well</div>');

		// **>>The AJAX View call HERE<<**
        // data appended
        ajax.view('albums/inline_full_image_view', {
            data: {
                guid: 123 // querystring
            },
        }).done(function (output, statusText, jqXHR) {
            if (jqXHR.AjaxData.status == -1) {
                return;
            }
            $('.full-image-view').html(output);
        });
    });
});