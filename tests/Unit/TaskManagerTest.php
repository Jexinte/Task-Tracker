<?php

/**
 * PHP version 8.
 *
 * @category tests/Unit
 * @package  TaskManager
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

use Enumeration\ColorTextName;
use Enumeration\Message;
use PHPUnit\Framework\TestCase;
use Service\TaskManager;
use Config\JsonFile;

class TaskManagerTest extends TestCase
{

    private TaskManager $taskManager;
    /**
     * Summary of jsonFile
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->taskManager = new TaskManager();
        
    }

    /**
     * Summary of testShouldReturnAllMessages
     * 
     * @return void
     */
    public function testShouldReturnAllMessages():void
    {
        ob_start();
        $this->taskManager->welcomeMessage();
        $value = ob_get_clean();
        
        $this->assertEquals($value,Message::WELCOME.implode('',Message::COMMANDS));
    }

}