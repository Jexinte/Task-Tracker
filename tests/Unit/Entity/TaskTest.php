<?php

/**
 * PHP version 8.
 *
 * @category tests/Unit/Entity
 * @package  TaskTest
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

use Entity\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase{
    /**
     * Summary of taskObj
     * 
     * @return Entity\Task
     */
    public function taskObj():Task
    {
        return new Task(1,"lorem ipsum","done",date('Y-m-d'),date('Y-m-d'));
    }

    /**
     * Summary of testShouldReturnTheSameId
     * 
     * @return void
     */
    public function testShouldReturnTheSameId():void
    {
         $this->assertSame(1,$this->taskObj()->getId());
    }

    /**
     * Summary of testShouldReturnTheSameDescription
     * 
     * @return void
     */
    public function testShouldReturnTheSameDescription():void
    {
         $this->assertSame("lorem ipsum",$this->taskObj()->getDescription());
    }

    /**
     * Summary of testShouldReturnTheSameStatus
     * 
     * @return void
     */
    public function testShouldReturnTheSameStatus():void
    {
         $this->assertSame("done",$this->taskObj()->getStatus());
    }

    /**
     * Summary of testShouldReturnTheSameCreatedAt
     * 
     * @return void
     */
    public function testShouldReturnTheSameCreatedAt():void
    {
         $this->assertSame(date('Y-m-d'),$this->taskObj()->getCreatedAt());
    }

    /**
     * Summary of testShouldReturnTheSameUpdatedAt
     * 
     * @return void
     */
    public function testShouldReturnTheSameUpdatedAt():void
    {
         $this->assertSame(date('Y-m-d'),$this->taskObj()->getUpdatedAt());
    }
}