$(document).ready(function() {
    $("#js-favourite i").click(function() {

        //.press represents fav is active and heart is red
        $(this).toggleClass('press');
        var isFav = $(this).hasClass('press') ? 1 : 0;

        genericAjax('/ajax/video/setfavouritestatus', { 'vid': vid, 'isfav': isFav }, 'get', function(json) {
            console.log(json);
            if (!json.status) {
                $(this).toggleClass('press');
            }
        });

    });

});
