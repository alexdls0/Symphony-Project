$('#js-removeAllHistory').click(function(e) {
    genericAjax('/ajax/account/delhistory', null, 'get', function(json) {
        if (json.status) {
            location.reload();
        }
    });
});

$('.js-removeHistory').click(function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    var estadoid = $(this).parent().parent().data('eid');
    var that = this;
    genericAjax('/ajax/account/delsinglehistory', { 'eid': estadoid }, 'get', function(json) {
        if (json.status) {
            $(that).closest('.item-row').css('opacity', '0.3');
            $(that).closest('.item-row').find('.js-removeHistory').remove();
        }
    });
});
