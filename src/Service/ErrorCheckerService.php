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

use Exception;
use Enumeration\Regex;
use Enumeration\Message;
use Enumeration\Color;



class ErrorCheckerService {

    /**
     * Summary of onAddCommandValues
     * 
     * @param string $value
     * 
     * @throws \Exception
     * 
     * @return string|bool
     */
    public function onAddCommandValues(string $value):string|bool
    {
        $firstPosOfDoublesQuotes = strpos($value,'"');
        $taskValue = substr($value,$firstPosOfDoublesQuotes);
        $theValueHaveTheFormatExpected = preg_match(Regex::TASK,$taskValue);

        if($theValueHaveTheFormatExpected){
            return $taskValue;
        }
        throw new Exception(" ".Message::TASK_NAME_FOR_THE_ADD_COMMAND_HAS_NOT_BEEN_SUPPLIED);
    }

    /**
     * Summary of onUpdateCommandValues
     * 
     * @param string $value
     * 
     * @throws \Exception
     * 
     * @return bool|array<int,string>
     */
    public function onUpdateCommandValues(string $value) : bool|array
    {
        preg_match(Regex::NUMBERS,$value,$matches);

        $id = $matches;
        
        $firstPosOfDoublesQuotes = strpos($value,'"');
        $taskName = substr($value,$firstPosOfDoublesQuotes);

        preg_match(Regex::TASK,$taskName,$matchesForTaskName);
        
        if(empty($id) || empty ($matchesForTaskName)){
            throw new Exception(" ".Message::TASK_NAME_FOR_THE_UPDATE_COMMAND_HAS_NOT_BEEN_SUPPLIED);
        }
         return [intval(current($id)),str_replace('"',"",$taskName)];
    }

    


    /**
     * Summary of onDeleteOrMarkInProgressOrMarkDoneCommandValues
     * 
     * @param string $value
     * @param string $command
     * 
     * @throws \Exception
     * 
     * @return array<int,string>
     */
    public function onDeleteOrMarkInProgressOrMarkDoneCommandValues(string $value,string $command = null):array
    {
        preg_match(Regex::NUMBERS,$value,$matches);

        $id = $matches;

        if(empty($id)){
            throw new Exception(" ".Message::TASK_ID_REQUIRED_TO_EXECUTE_THE_COMMAND);
        }

        return [intval(current($id)),$command];
    }

    /**
     * Summary of onListCommandWithoutAnythingElse
     * 
     * @param string $value
     * 
     * @throws \Exception
     * 
     * @return bool
     */
    public function onListCommandWithoutAnythingElse(string $value)
    {
        if(strlen($value) == 4 && preg_match(Regex::ON_LIST_COMMAND_FOR_ALL_TASKS,$value,$matches)){
            return true;
        }
        throw new Exception(" ".Message::TASK_CLI_LABEL.COLOR::YELLOW.Message::LIST_COMMAND_FOR_ALL_TASK_HAS_NOT_BEEN_SUPPLIED);
    }

}