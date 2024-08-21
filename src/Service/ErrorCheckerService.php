<?php

/**
 * PHP version 8.
 *
 * @category Service
 * @package  ErrorCheckerService
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

namespace Service;

use Enumeration\Regex;



class ErrorCheckerService {

    /**
     * Summary of onAddCommandValues
     * 
     * @param string $value
     * 
     * @return bool|string
     */
    public function onAddCommandValues(string $value):string|bool
    {
        $firstPosOfDoublesQuotes = strpos($value,'"');
        $taskValue = substr($value,$firstPosOfDoublesQuotes);
        $theValueHaveTheFormatExpected = preg_match(Regex::TASK,$taskValue);

        if($theValueHaveTheFormatExpected){
            return $taskValue;
        }
        return false;

    }

    /**
     * Summary of onUpdateCommandValues
     * 
     * @param string $value
     * 
     * @return bool|array<int,string>
     */
    public function onUpdateCommandValues(string $value) : bool|array
    {
        preg_match(Regex::NUMBERS,$value,$matches);

        $id = $matches;
        
        $firstPosOfDoublesQuotes = strpos($value,'"');
        $taskName = substr($value,$firstPosOfDoublesQuotes);

        if(empty($id) || empty (preg_grep(Regex::TASK,explode(' ',$taskName)))){
            return false;
        }
         return [intval(current($id)),$taskName];
    }

}