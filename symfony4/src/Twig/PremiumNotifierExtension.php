<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use \DateTime;

/**
 * Extends twig functionality by checking premium status
 */
class PremiumNotifierExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('notifypremium', [$this, 'isPremiumStatus']),
        ];
    }

    public function isPremiumStatus($userpremium) {
        $premiumstatus = true;
        if ($userpremium) {
            $now = new DateTime();
            if ($userpremium < $now) {
                $premiumstatus = false;
            }
        } else {
            $premiumstatus = false;
        }
        return $premiumstatus;
    }
}