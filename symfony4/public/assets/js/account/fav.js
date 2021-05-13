$('#js-removeAllFav').click(function(e) {
    genericAjax('/ajax/account/delfav', null, 'get', function(json) {
        if (json.status) {
            location.reload();
        }
    });
});

$('.js-removeFav').click(function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    var that = this;
    $(this).find('i').toggleClass('press');
    let favItem = $(this).closest('.content-item');
    let vid = favItem.data('vid');

    genericAjax('/ajax/account/delsinglefav', { 'vid': vid }, 'get', function(json) {
        if (json.status) {
            /*
            favItem.fadeOut().remove();
            if (!$('.fav-container').find('.content-item').length) {
                location.reload();
            }
            */
            favItem.css('opacity', '0.3');
            favItem.find('.js-removeHistory').remove();
        }
    });
});
