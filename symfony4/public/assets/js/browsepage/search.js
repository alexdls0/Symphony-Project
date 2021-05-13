//Variables to send to server
var firstrun = true;
var TYPE = null;
var ORDER = null;
var PREMIUM = null;
var COMPLETE = null;
var WATCHING = null;
var AGE = null;
var CATEGORIES = null;
var DIRECTORS = null;
var PRODUCERS = null;
var SEARCHTERM = '';
var gLimit = false;
var page = null;

//Retrieving data from elements
function getTypeValue() {

    page = 1;
    TYPE = $('#js-typeSel').find(":selected").val();
    hideOptions($('#js-typeSel').find(":selected").data('limit'));
    if (!firstrun) {
        queryServer();
    }
}
$('#js-typeSel').on('change', getTypeValue);

function getOrderValue() {
    ORDER = $('#js-orderSel').find(":selected").val();
    if (!firstrun) {
        queryServer();
    }
}
$('#js-orderSel').on('change', getOrderValue);

function getPremiumValue() {
    PREMIUM = $('#js-premiumLoad:checked').val();
    if (!firstrun) {
        queryServer();
    }
}
$('#js-premiumLoad').on('change', getPremiumValue);

function getCompleteValue() {
    COMPLETE = $('#js-completeLoad:checked').val();
    if (!firstrun) {
        queryServer();
    }
}
$('#js-completeLoad').on('change', getCompleteValue);

function getWatchingValue() {
    WATCHING = $('#js-watchingLoad:checked').val();
    if (!firstrun) {
        queryServer();
    }
}
$('#js-watchingLoad').on('change', getWatchingValue);

function getAgeValue() {
    AGE = $('#js-agerangeLoad').val();
    if (!firstrun) {
        queryServer();
    }
}
$('#js-agerangeLoad').on('change', getAgeValue);

function getCategoryList() {
    CATEGORIES = [];
    $('#js-categList option:selected').each(function() {
        CATEGORIES.push($(this).val());
    });
    if (!firstrun) {
        queryServer();
    }
}
$('#js-categList').on('change', function(e) {
    getCategoryList();
});

function getDirectorList() {
    DIRECTORS = [];
    $('#js-dirList option:selected').each(function() {
        DIRECTORS.push($(this).val());
    });
    if (!firstrun) {
        queryServer();
    }
}
$('#js-dirList').on('change', function(e) {
    getDirectorList();
});

function getProducerList() {
    PRODUCERS = [];
    $('#js-prodList option:selected').each(function() {
        PRODUCERS.push($(this).val());
        console.log($(this).val())
    });
    if (!firstrun) {
        queryServer();
    }
}
$('#js-prodList').on('change', function(e) {
    getProducerList();
});

function getSearchValue() {
    SEARCHTERM = $('#js-searchNameField').val().trim();
    if (!firstrun) {
        queryServer();
    }
}
$('#js-searchNameActive').on('click', getSearchValue);


function hideOptions(limit) {
    gLimit = limit;
    if (limit) {
        $('.js-hideOptions').children().fadeOut();
    }
    else {
        $('.js-hideOptions').children().fadeIn();
    }
}

function queryParams() {

    var data = {
        'type': TYPE,
        'order': ORDER,
        'searchterm': SEARCHTERM,
        'page': page
    };

    if (!gLimit) {
        data['premium'] = PREMIUM;
        data['complete'] = COMPLETE;
        data['watching'] = WATCHING;
        data['age'] = AGE;
        data['categories'] = CATEGORIES;
        data['directors'] = DIRECTORS;
        data['producers'] = PRODUCERS;
    }

    return data;

}

function queryServer() {
    var loader = $('.loader').clone().show().css('z-index', 150);
    loader.css('position', 'absolute');
    $('.browse-results').append(loader).fadeIn();
    genericAjax('/ajax/browse/getsearchresults', queryParams(), 'post', function(json) {
        $('.browse-results').find('.loader').fadeOut().remove();
        $('#js-resultsSection').html(json.data);
        $('#js-paginatorSection').html(json.paginator);
        appendEvents();
        //procesarTienda(json.items);
        //procesarPaginas(json.pages);
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
    $('.select2').select2();

    getTypeValue();
    getOrderValue();
    getPremiumValue();
    getCompleteValue();
    getWatchingValue();
    getAgeValue();
    getCategoryList();
    getDirectorList();
    getProducerList();
    getSearchValue();
    queryServer();

    firstrun = false;

}
init();
