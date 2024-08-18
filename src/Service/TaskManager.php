<?php

/**
 * PHP version 8.
 *
 * @category Service
 * @package  TaskManager
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */




namespace Service;

use Entity\Task;
use Config\JsonFile;
use Enumeration\TaskCommand;
use Enumeration\Color;
use Enumeration\Message;


require __DIR__."../../../vendor/autoload.php";



class TaskManager {


    /**
     * Summary of welcomeMessage
     * 
     * @return void
     */
    public function welcomeMessage():void
    {
        echo Message::WELCOME;
       foreach(Message::COMMANDS as $message)
       {
        echo $message;
       }
    }

}





