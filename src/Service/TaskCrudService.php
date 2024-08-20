<?php

/**
 * PHP version 8.
 *
 * @category Service
 * @package  TaskCrudService
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

namespace Service;

use Entity\Task;
use Config\JsonFile;
use Enumeration\Message;
use Enumeration\FilePath;

/**
 * Summary of TaskManagerCrud
 */
interface TaskManagerCrud {
    public function create(mixed $value):bool;
}



class TaskCrudService implements TaskManagerCrud{

    /**
     * Summary of __construct
     * 
     * @param JsonFile $jsonFile
     * @param Task $task
     */
    public function __construct(private JsonFile $jsonFile,private Task $task){}

    /**
     * Summary of create
     * 
     * @param string $taskValue
     * 
     * @return bool
     */
    public function create(mixed $taskValue):bool
    {

   
        if(is_string($taskValue)){
          
            $this->handleDataForCreate($taskValue);
            $stdOut = fopen('php://stdout','a');
            fwrite($stdOut,Message::TASK_ADDED_SUCCESSFULLY.$this->task->getId().")\n");
            fclose($stdOut);
            return true;
        }
        return false;
    }
    
    /**
     * Summary of handleDataForCreate
     * 
     * @param string $taskValue
     * 
     * @return void
     */
    public function handleDataForCreate(string $taskValue)
    {
        $this->task->setId();
        $this->task->setDescription($taskValue);
        $this->task->setStatus();
        $this->task->setCreatedAt();
        $this->task->setUpdatedAt();

        $data = [];
        $data["id"] = $this->task->getId();
        $data["description"] = $this->task->getDescription();
        $data["status"] = $this->task->getStatus();
        $data["createdAt"] = $this->task->getCreatedAt();
        $data["updatedAt"] = $this->task->getUpdatedAt();

        $originalArrayForData = $this->jsonFile->content();
        array_push($originalArrayForData,$data);

        $json = json_encode($originalArrayForData);
        file_put_contents(FilePath::TASKS,$json);
    }

}