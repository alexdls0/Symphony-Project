//Variables to send to server
var firstrun = true;
var PARENTID = null;
var CURRENTID = null;
var page = null;

//Retrieving data from elements
function getTypeValue() {

    // When user selects other option, page is 1
    page = 1;
    CURRENTID = $('#js-seasonSelect').find(":selected").val();
    PARENTID = $('#js-seasonSelect').find(":selected").data('parent');
    if (!firstrun) {
        queryServer();
    }
}
$('#js-seasonSelect').on('change', getTypeValue);

function queryParams() {

    var data = {
        'page': page,
        'current': CURRENTID,
        'parent': PARENTID
    };
    return data;
}

function queryServer() {
    var loader = $('.loader').clone().show().css('z-index', 150);
    $('#js-resultsSection').append(loader).fadeIn();

    genericAjax('/ajax/show/getvideosofshow', queryParams(), 'get', function(json) {
        $('.browse-results').find('.loader').fadeOut().remove();
        $('#js-resultsSection').html(json.data);
        $('#js-paginatorSection').html(json.paginator);
        appendEvents();
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
function init() {
    getTypeValue();
    queryServer();
    firstrun = false;
}
init();
