<?php

namespace App\Service;

/*
 * Quick mafs
 */
class MathService {

    public function percent($num1, $num2) {
        if ($num1 == 0) {
            return 0;
        } else {
            return (($num1 / $num2) * 100);
        }

    }

}