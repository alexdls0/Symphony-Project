function genericAjax(url, data, type, callBack) {
    $.ajax({
            url: url,
            data: data,
            type: type,
            dataType: 'json',
        })
        .done(function(json) {
            console.log('ajax done');
            callBack(json);
        })
        .fail(function(xhr, status, errorThrown) {
            console.log('ajax fail');
        })
        .always(function(xhr, status) {
            console.log('ajax always');
        });
};
