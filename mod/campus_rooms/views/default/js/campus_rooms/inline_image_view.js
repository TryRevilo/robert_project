require(['elgg/Ajax'], Ajax => {

  var ajax = new Ajax();

  $('.kv-file-zoom').click(function(event) {
    event.preventDefault();
    var $elem = $(this);
    var guid = $elem.data('guid');

    ajax.view('albums/inline_full_image_view', {
         //data: $elem.data(),
         data: {guid: guid},
       }).then(body => {
        $( '.file-full-view-frame' ).html(body);
      })
     });
});