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

use Config\JsonFile;
use Entity\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase{
    
     private Task $task;
     private JsonFile $jsonFile;

    public function setUp():void
    {
          parent::setUp();
          $this->jsonFile = new JsonFile();
          $this->task = new Task($this->jsonFile);
    }

    /**
     * Summary of testShouldReturnTheSameId
     */
    public function testShouldReturnTheSameId():void
    {
         $this->task->setId();
         $this->assertSame(1,$this->task->getId());
    }

    /**
     * Summary of testShouldReturnTheSameDescription
     */
    public function testShouldReturnTheSameDescription():void
    {
         $this->task->setDescription("lorem ipsum");
         $this->assertSame("lorem ipsum",$this->task->getDescription());
    }

    /**
     * Summary of testShouldReturnTheSameStatus
     */
    public function testShouldReturnANullStatus():void
    {
         $this->task->setStatus();
         $this->assertSame(null,$this->task->getStatus());
    }

    /**
     * Summary of testShouldReturnTheSameCreatedAt
     */
    public function testShouldReturnTheSameCreatedAt():void
    {
         $this->task->setCreatedAt();
         $this->assertSame(date('Y-m-d'),$this->task->getCreatedAt());
    }

    /**
     * Summary of testShouldReturnTheSameUpdatedAt
     */
    public function testShouldReturnTheSameUpdatedAt():void
    {
         $this->task->setUpdatedAt();
         $this->assertSame(null,$this->task->getUpdatedAt());
    }
}