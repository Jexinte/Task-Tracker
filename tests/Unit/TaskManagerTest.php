<?php

/**
 * PHP version 8.
 *
 * @category tests/Unit
 * @package  TaskManagerTest
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

use PHPUnit\Framework\TestCase;
use Service\TaskManager;

class TaskManagerTest extends TestCase
{

    public TaskManager $taskManager;
    

    /**
     * Summary of setUp
     * 
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->taskManager = new TaskManager();
    }

       
}
   
