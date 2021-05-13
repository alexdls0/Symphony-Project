<?php

namespace App\Service;

use App\Utils\CurlHelper;

class CaptchaService {

    /**
     * Server-side captcha validation
     * 
     * @param type $capResponse
     * @return type
     */
    public function validate($capResponse) {
        $returned = null;
        $data = array(
            'secret' => getenv('RECAPTHA_S_KEY'),
            'response' => $capResponse
        );

        $captcha_success = $this->requestData($data);

        if (!is_null($captcha_success)) {
            $returned = $captcha_success['success'];
        }
        return $returned;
    }

    /**
     * Receives an array of parameters to give to Google.
     * They then return a json.
     * 
     * @param type $params
     * @return type
     */
    private function requestData($params) {
        $linkenv = 'https://www.google.com/recaptcha/api/siteverify';
        if (CurlHelper::urlExists($linkenv)) {
            $req = curl_init($linkenv);
            curl_setopt($req, CURLOPT_POST, 1);
            curl_setopt($req, CURLOPT_HEADER, FALSE);
            curl_setopt($req, CURLOPT_NOBODY, FALSE);
            curl_setopt($req, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($req, CURLOPT_RETURNTRANSFER, TRUE);
            $json = curl_exec($req);
            curl_close($req);
            $jsonReturn = json_decode($json, true);
        } else {
            $jsonReturn = null;
        }
        return $jsonReturn;
    }

}