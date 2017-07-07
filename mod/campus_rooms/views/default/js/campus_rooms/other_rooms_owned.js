require(['elgg/Ajax'], Ajax => {

  var ajax = new Ajax();

  $('.kv-room-zoom').click(function(event) {
    event.preventDefault();
    var $elem = $(this);
    var guid = $elem.data('guid');

    ajax.view('rentals/other_rooms_owned/inline_full_room_view', {
         //data: $elem.data(),
         data: {guid: guid},
       }).then(body => {
        $( '.room-full-view-frame' ).html(body);
      })
     });
});