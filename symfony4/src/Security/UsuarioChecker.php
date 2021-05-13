<?php
namespace App\Security;

use App\Entity\Usuario;
use App\Exception\AccountDisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Checks that a user account meets certain parameters on login.
 */
class UsuarioChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof Usuario) {
            return;
        }

        if (empty($user->getActivo())) { //Empty: null 0 or ""
            throw new AccountDisabledException();
        }
    }

    public function checkPostAuth(UserInterface $user) {
        //Function declaration is required by parent.
    }
}