<?php

/**
 * PHP version 8.
 *
 * @category config
 * @package  JsonFile
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

namespace Config;


use Enumeration\FolderPath;
use Enumeration\FilePath;

class JsonFile{

    /**
     * Summary of tasks
     * @var array<string>
     */
    public ?array $tasks;
    /**
     * Summary of isCreated
     *
     * @return bool
     */
    public function isCreated(): ?bool
    {
        $files = scandir(FolderPath::CONFIG);
        $filename = basename(FilePath::TASKS,"tasks.json");
        return in_array($filename,$files);
        
    }
    
    /**
     * Summary of create
     */
    public function create(): void
    {
        if(!$this->isCreated()){
        $file = fopen(FilePath::TASKS,"w");
        fclose($file);
        }

    }
    
    /**
     * Summary of content
     *
     * @return array<null|string>
     */
    public function content(): ?array
    {           
        switch(true)
        {
            case file_exists(FilePath::TASKS) && is_null(json_decode(file_get_contents(FilePath::TASKS),true)):
                $this->tasks = [];
            break;

            default:
            $this->tasks = json_decode(file_get_contents(FilePath::TASKS),true);
            break;
        }
        return  $this->tasks;
            
    }

}