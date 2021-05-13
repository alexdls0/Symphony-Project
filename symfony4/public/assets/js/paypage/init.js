$(document).ready(function() {
    var priceBase = null;
    var priceMul = 1;

    function getInfo() {
        genericAjax('/ajax/payment/getcurrentbaseprice', null, 'get', function(json) {
            priceBase = json.price;
            renderPrice();
        });
    }

    function renderPrice() {
        var total = priceMul * priceBase;
        var percent = (priceMul / 100) * total;
        var grandtotal = total - percent;
        $('#js-priceDisplay').html(grandtotal.toFixed(2));
    }

    $('.js-activePlan').on('change', function(e) {
        priceMul = $('.js-activePlan input:radio:checked').val();
        renderPrice();
    });


    var plans = [];
    $('.js-activePlan input:radio').each(function() {
        $(this).removeAttr('required');

        /**
         * We collect all the labels of the plans to show
         * them in the slider of plans
         */
        let planName = $(this).next().text();
        planName = planName.replace(/\s/g, '');
        let radioId = $(this).attr('id');
        let planMul = $(this).val();
        let plan = {
            'planName': planName,
            'planMul': planMul,
            'radioId': radioId,
        };
        plans.push(plan);
    });
    $('.js-activePlan input:radio').first().prop('checked', true);
    $('.payment-tab-header h1').each(function(i) {
        $(this).text(plans[i].planName);
        $(this).data('mul', plans[i].planMul);
        $(this).data('radioId', plans[i].radioId);
    });

    /**
     * Plan list
     */
    $('.payment-tab-header h1').click(function() {

        priceMul = $(this).data('mul');

        $('.payment-tab-header h1').removeClass('active');
        $(this).addClass('active');

        let radioId = $(this).data('radioId');
        let radio = $('#' + radioId);
        radio.prop('checked', true);

        renderPrice();
    });

    getInfo();

});
