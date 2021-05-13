<?php

namespace App\Exception;
use \Symfony\Component\Security\Core\Exception\AuthenticationException;

class AccountDisabledException extends AuthenticationException {
    /**
     * Account not active message
     * @return string
     */
    public function getMessageKey()
    {
        return 'Account is not active';
    }
}