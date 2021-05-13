//Variables to send to server
var firstrun = true;
var PARENTID = null;
var CURRENTID = null;
var page = null;

//Retrieving data from elements
function getTypeValue() {

    // When user selects other option, page is 1
    page = 1;
    CURRENTID = $('#js-info').data('this');
    PARENTID = $('#js-info').data('parent');
    if (!firstrun) {
        queryServer();
    }
}

function queryParams() {

    var data = {
        'page': page,
        'current': CURRENTID,
        'parent': PARENTID
    };
    return data;
}

function queryServer() {
    //var loader = $('.loader').clone().show().css('z-index', 150);
    //$('#js-resultsSection').append(loader).fadeIn();
    genericAjax('/ajax/show/getvideosofshow', queryParams(), 'get', function(json) {
        //$('.browse-results').find('.loader').fadeOut().remove();
        $('#js-resultsSection').html(json.data);
        $('#js-paginatorSection').html(json.paginator);
        reStyle();
        appendEvents();
    });
}

function reStyle() {

    var lista = $('#js-resultsSection');
    var rows = lista.find('.item-row').each(function() {
        if ($(this).data('id') == vid) {
            $(this).addClass('actual-item');
            console.log($(this))
            return;
        }
    });
}

function appendEvents() {

    $('.js-paginationLink').on('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        page = $(this).data('newpage');
        queryServer();
    });

}

//First query
function initSeason() {
    getTypeValue();
    queryServer();
    firstrun = false;
}
initSeason();
