require(['elgg/Ajax'], Ajax => {

	var ajax = new Ajax();

	$('.glyphicon-zoom-in').click(function(event) {

		$( '.full-image-view' ).css( "color", "red" ).append('<div>This Shows Well</div>');

		// **>>The AJAX View call HERE<<**

		ajax.view('albums/inline_full_image_view').then(body => {
            $( '.full-image-view' ).append(body);
        })
    });
});