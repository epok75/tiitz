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
    const BAD_LENGTH = "le texte ne contient pas la longueur indiquee";
    const BAD_LENGTH_PATTERN = "la comparaison de taille est mal saisie";
    const BAD_URL = "l'url saisie n'est pas valide";
    const BAD_PATTERN = "le pattern saisi ne correspond pas au pattern demande";
    const BAD_TYPE_PATTERN = "ce type n'existe pas ou ne peut pas être verifie";
    
    const BAD_FLAG = "";
    private static $errors = array();
    
    private static function addError($elem, $err)
    {
        array_push(self::$errors, $elem.": ".$err);
    }
    
    public static  function getErrors()
    {
        return(self::$errors);
    }
    
    public static function checkType($elem, $type)
    {
        if($type == "EMAIL")
        {
            if(self::checkMail($elem) != "")
                self::addError($elem, self::BAD_EMAIL);
            return(self::checkMail($elem));
        }
        if($type == "IP")
        {
            if(self::checkIp($elem) != "")
                self::addError($elem, self::BAD_IP);
            return(self::checkIP($elem));
        }
        if($type == "STRING")
        {
            if(self::checkString($elem) != "")
                self::addError($elem, self::BAD_STRING);
            return(self::checkString($elem));
        }
        if($type == "URL")
        {
            if(self::checkUrl($elem) != "")
                self::addError($elem, self::BAD_URL);
            return(self::checkUrl($elem));
        }
        if($type == "INT")
        {
            if(self::checkInt($elem) != "")
                self::addError($elem, self::BAD_INT);
            return(self::checkInt($elem));
        }
        if($type == "FLOAT")
        {
            if(self::checkFloat($elem) != "")
                self::addError($elem, self::BAD_FLOAT);
            return(self::checkFloat($elem));
        }
        self::addError($elem, self::BAD_TYPE_PATTERN);
        return(self::BAD_TYPE_PATTERN);
    }
    
    
    /* Check the length of a string for the checkMulti function*/
    public static function checkLength($elem, $constraint)
    {
        $nbChar = "";
        $toCompare = str_split(str_replace(" ", "",$constraint));
        if(($toCompare[0] == "<" && $toCompare[1] == "=") || ($toCompare[0] == ">" && $toCompare[1] == "=") || ($toCompare[0] == "=" && $toCompare[1] == "=") || ($toCompare[0] == "!" && $toCompare[1] == "="))
        {
            foreach($toCompare as $k=>$v)
            {
                if($k != 0 && $k != 1)
                {
                    if(ctype_digit($v))
                        $nbChar .= $v;
                    else
                    {
                        self::addError($elem, self::BAD_LENGTH_PATTERN);
                        return(self::BAD_LENGTH_PATTERN);
                    }
                }
            }
            if($toCompare[0] == "<" && $toCompare[1] == "=")
            {
                if(strlen($elem) <= $nbChar)
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }
            }
            if($toCompare[0] == ">" && $toCompare[1] == "=")
            {
                if(strlen($elem) >= $nbChar)
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }
            }
            if($toCompare[0] == "!" && $toCompare[1] == "=")
            {
                if(strlen($elem) != $nbChar)
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }
            }
            if($toCompare[0] == "=" && $toCompare[1] == "=")
            {
                if(strlen($elem) == $nbChar)
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }   
            }
            self::addError($elem, self::BAD_LENGTH_PATTERN);
            return(self::BAD_LENGTH_PATTERN);
        }
        if($toCompare[0] == "<" || $toCompare[0] == ">")
        {
            foreach($toCompare as $k=>$v)
            {
                if($k != 0)
                {
                    if(ctype_digit($v))
                        $nbChar .= $v;
                    else
                    {
                        self::addError($elem, self::BAD_LENGTH_PATTERN);
                        return(self::BAD_LENGTH_PATTERN);
                    }
                }
            }
            if($toCompare[0] == "<")
            {
                if(strlen($elem) < $nbChar)
                    return("");
                else
                {
                    self::addError($elem, self::BAD_LENGTH);
                    return(self::BAD_LENGTH);
                }
            }
            if($toCompare[0] == ">" && $nbChar)
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
        self::addError($elem, self::BAD_LENGTH_PATTERN);
        return(self::BAD_LENGTH_PATTERN);
    }
    
    /*  
     *  VALIDATION METHODS  
     */
    
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
    public static function checkString($str){
        if(!is_string($str))
            return(self::BAD_STRING);
        return("");
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
    
    /* 
     * CLEANING METHODS 
     */
    
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
    
    /* 
     * PARSER FOR MULTI CONSTRAINTS CHECK 
     */
    
    public static function checkMulti($str, $req = null){
        if($req != null)
        {
            if(array_key_exists("LENGTH", $req))
                self::checkLength($str, $req["LENGTH"]);
            if(array_key_exists("TYPE", $req))
                self::checkType($str, $req["TYPE"]);
        }
    }
}