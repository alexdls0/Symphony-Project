/**
 * Used to verify than an email exists for recovery.
 */
(function() {

    var serverUrl = 'ajax/account/recoverpassword';
    var mailInput = document.getElementById('js-recoverInput');

    /**
     * Ajax function
     */
    function genericAjax(url, data, type, callBack) {
        $.ajax({
                url: url,
                data: data,
                type: type,
                dataType: 'json'
            })
            .done(function(json) {
                console.log('AJAX Request sent');
                callBack(json);
            })
            .fail(function(xhr, status, errorThrown) {
                console.log('AJAX Request failed');
            });
    }

    /**
     * Function that cancels the textbox upon validation
     */
    function mailMessage(status) {
        var $emailbox = $('#js-emailReplace p');
        if (status) {
            var $string = 'Address found. Check your inbox.';
            mailInput.value = '';
            buttonStatus(false);
        }
        else {
            var $string = 'Address not found. Check the e-mail.';
        }
        $emailbox.html($string);
    }

    /**
     * Function that enables/disables the send button
     */
    function buttonStatus(active) {
        var $sendbtn = document.getElementById('js-recoverSend');
        if (active) {
            $sendbtn.removeAttribute("disabled");
            $sendbtn.classList.remove('disabled-bt');
            $sendbtn.classList.add('enabled-bt');
            $sendbtn.contentText = 'Sent';
        }
        else {
            $sendbtn.setAttribute("disabled", "");
            $sendbtn.classList.add('disabled-bt');
            $sendbtn.classList.remove('enabled-bt');
        }
    }
    $('#js-recoverSend').click(function() {
        var recoverField = mailInput.value.trim();
        genericAjax(serverUrl, { 'email': recoverField }, 'post', function(json) {
            if (json != null || json.found) {
                mailMessage(json.found);
            }
            else {
                mailMessage(false);
            }
        });
    })

    /**
     * Function to check if e-mail is valid
     */
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    /**
     * Check valid e-mail while typing
     */
    mailInput.addEventListener('keyup', function(event) {
        var recoverField = mailInput.value.trim();
        if (isEmail(recoverField)) {
            buttonStatus(true);
        }
    });
})();
