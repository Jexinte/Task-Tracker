<?php

/**
 * PHP version 8.
 *
 * @category tests/Unit
 * @package  TaskTest
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

use Config\JsonFile;
use Enumeration\FilePath;
use PHPUnit\Framework\TestCase;


class JsonFileTest extends TestCase{
    
    /**
     * Summary of jsonFile
     * 
     * @return Config\JsonFile
     */
    public function jsonFile():JsonFile
    {
        return new JsonFile();
    }

    /**
     * Summary of setUpJsonFile
     * 
     * @return void
     */
    public function setUpJsonFile():void
    {
        $this->jsonFile()->create();
    }
  
    /**
     * Summary of testShouldReturnFalseIfFileNotCreated
     * 
     * @return void
     */
    public function testShouldReturnFalseIfFileNotCreated():void
    {
        $this->assertSame(false,$this->jsonFile()->isCreated());
    }

    /**
     * Summary of testShouldReturnAJsonFile
     * 
     * @return void
     */
    public function testShouldReturnAJsonFile():void
    {
        $this->setUpJsonFile();
        $this->assertFileExists(FilePath::TASKS);
    }

    /**
     * Summary of testShouldReturnAnEmptyArrayWhenFileDoesntExist
     * 
     * @return void
     */
    public function testShouldReturnAnEmptyArrayWhenFileDoesntExist():void
    {
        $this->assertSame([],$this->jsonFile()->content());
    }

  
}