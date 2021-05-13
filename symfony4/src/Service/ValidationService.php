<?php

namespace App\Service;

/*
 * Validates fields
 */

class ValidationService {

    /**
     * Helper function that validates an email, token and timestamp
     * Used by ForgotPasswordController
     */
    public function validateTokenTime($mailtoken) {
        $valid = false;
        $currtime = time();

        $totaltime = ($currtime - $mailtoken);
        $hours = floor($totaltime / 3600);

        if ($hours <= 1) {
            $valid = true;
        } else {
            $valid = false;
        }

        return $valid;
    }

    public function validateNew() {
        
    }

    public function validateEmail($mail) {
        if (empty($mail)) {
            return false;
        } else {
            return true;
        }
    }

    public function validateUsername($uname) {
        if (empty($uname)) {
            return false;
        } else {
            return true;
        }
    }

    public function validatePassword($pass) {
        $regex = $this->regexPassword();
        if (empty($pass) || (strlen($pass)) < 6 || !\preg_match($regex, $pass)) {
            return false;
        } else {
            return true;
        }
    }

    public function validateCrypt($param) {
        if (empty($param) || strlen($param) < 32) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Password regex (?=\S*[\d]) must contain at least a number
     * @return string
     */
    public function regexPassword() {
        return "^\S*(?=\S*[\d])\S*$^";
    }
    
    //Nombre con sentido
    public function regexNameSense() {
        return "/^([a-zA-Z0-9áéíóúÁÉÍÓÚñÑçÇ]){1}([a-zA-Z0-9áéíóúÁÉÍÓÚñÑçÇ\-\s])*([a-zA-Z0-9áéíóúÁÉÍÓÚñÑçÇ]){1}$/i";
    }
    
    //Nombre con sentido
    public function regexRealNameSense() {
        return "/^([a-zA-ZáéíóúÁÉÍÓÚñÑçÇ]){1}([a-zA-ZáéíóúÁÉÍÓÚñÑçÇ\-\s])*([a-zA-ZáéíóúÁÉÍÓÚñÑçÇ]){1}$/i";
    }
    
    //Apodo con sentido
    public function regexNickSense() {
        return "/^([a-zA-Z0-9]){1}([a-zA-Z0-9\-\_])*([a-zA-Z0-9]){1}$/i";
    }
    
    //Número de las temporadas
    public function regexOneOrTwoDigits() {
        return "/^([1-9]){1}([0-9]){0,1}$/i";
    }
    
    //Validación clasificación por edades
    public function regexClasificationAge() {
        return "/^([0-9]|1[0-8])$/i";
    }
    
    //Validación tarjeta
    public function regexCard() {
        return "/^([0-9]){13,18}$/i";
    }
    
    //Nombre para vídeos
    public function regexNameVideoSense() {
        return "/^([a-zA-Z0-9áéíóúÁÉÍÓÚñÑçÇ\(\)]){1}([a-zA-Z0-9áéíóúÁÉÍÓÚñÑçÇ\-\s\.\_\:\(\)\'])*([a-zA-Z0-9áéíóúÁÉÍÓÚñÑçÇ\(\)\']){1}$/i";
    }
    
    public function regexNumbersOnly() {
        return "/^[0-9]*$/";
        
    }
    
}