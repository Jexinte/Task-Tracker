<?php

/**
 * PHP version 8.
 *
 * @category Entity
 * @package  Task
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

namespace Entity;


class Task{

    /**
     * Summary of task
     * 
     * @var array<string>
     */
    public array $task = [];
    
    public function __construct(public int $id,public string $description,public string $status,public string $createdAt , public string $updatedAt){
    }

    /**
     * Summary of getId
     * 
     * @return int
     */
    public function getId():int
    {
      return $this->id;
    }

    /**
     * Summary of getDescription
     * 
     * @return string
     */
    public function getDescription():string
    {
      return $this->description;
    }
    
    /**
     * Summary of getStatus
     * 
     * @return string
     */
    public function getStatus():string
    {
      return $this->status;
    }

    /**
     * Summary of getCreatedAt
     * 
     * @return string
     */
    public function getCreatedAt():string
    {
      return $this->createdAt;
    }

    /**
     * Summary of getUpdatedAt
     * 
     * @return string
     */
    public function getUpdatedAt():string
    {
      return $this->createdAt;
    }

    /**
     * Summary of getTask
     * 
     * @return string[]
     */
    public function getTask():array
    {
        return $this->task;
    }
   
}