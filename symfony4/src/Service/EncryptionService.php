<?php

namespace App\Service;

/**
 * Encrypts and decrypts data.
 */
class EncryptionService {

    private $key;

    public function __construct() {
        //Secret encryption key in .env file
        $this->key = getenv('BG_ENCRYPTION_KEY');
    }

    public function encrypt($plaintext) {
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary = true);
        return $this->base64_url_encode($iv . $hmac . $ciphertext_raw);
    }

    public function decrypt($ciphertext) {
        $c = $this->base64_url_decode($ciphertext);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary = true);
        if (hash_equals($hmac, $calcmac)) {//PHP 5.6+ timing attack safe comparison
            return $original_plaintext;
        } else {
            return null;
        }
    }
    
    function base64_url_encode($input) {
        return strtr(base64_encode($input), '+/=', '._-');
       }

       function base64_url_decode($input) {
        return base64_decode(strtr($input, '._-', '+/='));
       }

}
