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
    
     private Task $task;

    public function setUp():void
    {
          parent::setUp();
          $this->task = new Task();
    }

    /**
     * Summary of testShouldReturnTheSameId
     * 
     * @return void
     */
    public function testShouldReturnTheSameId():void
    {
         $this->task->setId(1);
         $this->assertSame(1,$this->task->getId());
    }

    /**
     * Summary of testShouldReturnTheSameDescription
     * 
     * @return void
     */
    public function testShouldReturnTheSameDescription():void
    {
         $this->task->setDescription("lorem ipsum");
         $this->assertSame("lorem ipsum",$this->task->getDescription());
    }

    /**
     * Summary of testShouldReturnTheSameStatus
     * 
     * @return void
     */
    public function testShouldReturnANullStatus():void
    {
         $this->task->setStatus();
         $this->assertSame(null,$this->task->getStatus());
    }

    /**
     * Summary of testShouldReturnTheSameCreatedAt
     * 
     * @return void
     */
    public function testShouldReturnTheSameCreatedAt():void
    {
         $this->task->setCreatedAt(date('Y-m-d'));
         $this->assertSame(date('Y-m-d'),$this->task->getCreatedAt());
    }

    /**
     * Summary of testShouldReturnTheSameUpdatedAt
     * 
     * @return void
     */
    public function testShouldReturnTheSameUpdatedAt():void
    {
         $this->task->setUpdatedAt();
         $this->assertSame(null,$this->task->getUpdatedAt());
    }
}