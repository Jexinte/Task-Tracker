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

use Config\JsonFile;


class Task{


    
    public int $id;
    public string $description;
    public ?string $status;
    public string $createdAt;
    public ?string $updatedAt;

    /**
     * Summary of __construct
     */
    public function __construct(private JsonFile $jsonFile){
      if(!$this->jsonFile->isCreated()){
        $this->jsonFile->create();
    }
    }
    
    /**
     * Summary of setId
     */
    public function setId():void
    {
      switch(true){
        case $this->jsonFile->content() === null || $this->jsonFile->content() === []:
        $this->id = 1;
        break;
        
        default:
       $this->id = count($this->jsonFile->content()) + 1;
       break; 
      }
    }

    /**
     * Summary of setDescription
     *
     *
     */
    public function setDescription(string $description):void
    {
      $this->description = $description;
    }

    /**
     * Summary of setStatus
     *
     * @param string $status
     */
    public function setStatus(?string $status = null):void
    {
      $this->status = $status;
    }

    /**
     * Summary of setCreatedAt
     */
    public function setCreatedAt():void
    {
      $this->createdAt = date('Y-m-d');
    }

    /**
     * Summary of setUpdatedAt
     *
     * @param string $updatedAt
     */
    public function setUpdatedAt(?string $updatedAt = null):void 
    {
      $this->updatedAt = $updatedAt;
    }


    /**
     * Summary of getId
     */
    public function getId():int
    {
      return $this->id;
    }

    /**
     * Summary of getDescription
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
