<?php

namespace App\Service;

use App\Utils\CurlHelper;

/*
 * Validates fields
 */
class OMDBService {
    
    private $token = null;

    public function __construct() {
        $this->token = getenv('OMDB_API_KEY');
    }
    
    public function request($search) {
        $url = 'http://www.omdbapi.com/?apikey='.$this->token.'&t='.$search;
        return $this->fetchData($url);
    }
    
    private function fetchData($url) {
        if (CurlHelper::urlExists($url)) {
            $req = curl_init($url);
            curl_setopt($req, CURLOPT_HEADER, FALSE);
            curl_setopt($req, CURLOPT_NOBODY, FALSE);
            curl_setopt($req, CURLOPT_RETURNTRANSFER, TRUE);
            $json = curl_exec($req);
            curl_close($req);
            return json_decode($json, true);
        } else {
            return null;
        }
    }
    
}