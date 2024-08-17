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


    
    public int $id;
    public string $description;
    public ?string $status;
    public string $createdAt;
    public ?string $updatedAt;
    
    /**
     * Summary of setId
     * 
     * @param int $id
     * 
     * @return void
     */
    public function setId($id):void
    {
      $this->id = $id;
    }

    /**
     * Summary of setDescription
     * 
     * @param string $description
     * 
     * @return void
     */
    public function setDescription(string $description):void
    {
      $this->description = $description;
    }

    /**
     * Summary of setStatus
     * 
     * @param string $status
     * 
     * @return void
     */
    public function setStatus(?string $status = null):void
    {
      $this->status = $status;
    }

    /**
     * Summary of setCreatedAt
     * 
     * @param string $createdAt
     * 
     * @return void
     */
    public function setCreatedAt(string $createdAt):void
    {
      $this->createdAt = $createdAt;
    }

    /**
     * Summary of setUpdatedAt
     * 
     * @param string $updatedAt
     * 
     * @return void
     */
    public function setUpdatedAt(?string $updatedAt = null):void 
    {
      $this->updatedAt = $updatedAt;
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
    public function getStatus():?string
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
    public function getUpdatedAt():?string
    {
      return $this->updatedAt;
    }

}
