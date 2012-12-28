<?php

/**
 * TiiTz Generic pattern validator
 *
 * @author Hodor
 */
class validator {
    
    const BAD_EMAIL = "l'adresse email n'est pas valide";
    const BAD_IP = "l'adresse ip n'est pas valide";
    const BAD_INT = "le nombre n'est pas valide";
    const BAD_FLOAT = "le chiffre flottant n'est pas valide";
    const BAD_STRING = "le texte n'est pas valide";
    const BAD_LENGTH = "votre texte ne contient pas la longueur indiqu&eacute;e";
    const BAD_URL = "l'url saisie n'est pas valide";
    const BAD_PATTERN = "le pattern saisi ne correspond pas au pattern demand&eacute;";
    
    const BAD_FLAG = "";
    private static $errors = array();
    
    private static function addError($elem, $err)
    {
        array_push(self::$errors, "element : ".$err);
    }
    
    public static function checkLength($elem, $constraint)
    {
        $toCompare = str_split(str_replace(" ", $constraint));
        if(count($toCompare) == 3)
        {
            if($toCompare[0] == "<" && $toCompare[1] == "=" && ctype_digit($toCompare[2]))
            {
                if(strlen($elem) <= $toCompare[2])
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }
            }
            if($toCompare[0] == ">" && $toCompare[1] == "=" && ctype_digit($toCompare[2]))
            {
                if(strlen($elem) >= $toCompare[2])
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }
            }
            if($toCompare[0] == "=" && $toCompare[1] == "=" && ctype_digit($toCompare[2]))
            {
                if(strlen($elem) == $toCompare[2])
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }
            }
        }
        if(count($toCompare) == 2)
        {
            if($toCompare[0] == "<" && ctype_digit($toCompare[1]))
            {
                if(strlen($elem) < $toCompare[1])
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }
            }
            if($toCompare[0] == ">" && ctype_digit($toCompare[1]))
            {
                if(strlen($elem) > $toCompare[1])
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }
            }
        }
        var_dump($toCompare);
    }
    
    /*  VALIDATION METHODS  */
    
    /*VALIDATES VALUE AS EMAIL ADDRESS: returns the message linked to the BAD_EMAIL CONST if email is not valid, else returns an empty string*/
    public static function checkMail($mail){
        if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
            return(self::BAD_EMAIL);
        return("");
    }
    
    /*VALIDATES VALUE AS URL: returns the message linked to the BAD_URL CONST if url is not valid, else returns an empty string*/
    public static function checkUrl($url){
        if(!filter_var($url, FILTER_VALIDATE_URL))
            return(self::BAD_URL);
        return("");
    }
    
    /*VALIDATES VALUE AS IP ADDRESS: returns the message linked to the BAD_IP CONST if number is not an integer, else returns an empty string*/
    public static function checkIp($ip){
        if(!filter_var($ip, FILTER_VALIDATE_IP))
            return(self::BAD_IP);
        return("");
    }
    
    /*VALIDATES VALUE AS STRING: returns the message linked to the BAD_STRING CONST if str is not valid, else returns an empty string*/
    public static function checkString($str, $req){
        
        if(!is_string($str))
            self::addError($str, self::BAD_STRING);
        if($req != null)
        {
            if(array_key_exists("LENGTH", $req))
            {
                self::checkLength($str, $req["LENGTH"]);
                self::addError($str, self::BAD_LENGTH);
            }
        }
        var_dump(self::$errors);
    }
    
    /*VALIDATES VALUE AS INTEGER: returns the message linked to the BAD_INT CONST if number is not an integer, else returns an empty string*/
    public static function checkInt($number){
        if(!filter_var($number, FILTER_VALIDATE_INT))
            return(self::BAD_INT);
        return("");
    }
    
    /*VALIDATES VALUE AS FLOAT: returns the message linked to the BAD_FLOAT CONST if numberFloat is not a float, else returns an empty string*/
    public static function checkFloat($numberFloat){
        if(!filter_var($numberFloat, FILTER_VALIDATE_FLOAT))
            return(self::BAD_FLOAT);
        return("");
    }
    
    /*VALIDATES VALUE AGAINST PATTERN: returns the message BAD_PATTERN CONST if toCheck does not match pattern, else returns an empty string*/
    public static function checkStringExp($toCheck, $pattern){
        if(!filter_var($toCheck, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>$pattern))))
            return(self::BAD_PATTERN);
        return("");
    }
    
    /* CLEANING METHODS */
    
    /*CLEANS AN EMAIL: Remove all characters except letters, digits and !#$%&'*+-/=?^_`{|}~@.[]*/
    public static function cleanMail($mail){
        return(filter_var($mail, FILTER_SANITIZE_EMAIL));
    }
    
    /*CLEANS AN URL: URL-encode string, optionally strip or encode special characters*/
    public static function cleanUrl($url){
        return(filter_var($url, FILTER_SANITIZE_URL));
    }
    
    /*CLEANS A NUMBER : delete all chars, except numbers, +- */
    public static function cleanInt($number){
        return(filter_var($number, FILTER_SANITIZE_NUMBER_INT));
    }
    
    /*CLEANS A FLOAT NUMBER : Remove all characters except digits, +- and optionally .,eE*/
    public static function cleanFloat($numberFloat){
        return(filter_var($numberFloat, FILTER_SANITIZE_NUMBER_FLOAT));
    }
}