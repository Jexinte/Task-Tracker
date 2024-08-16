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
     * Summary of isCreated
     *
     * @return bool
     */
    public function isCreated(): ?bool
    {
        $files = scandir(FolderPath::CONFIG);

        if(is_array($files) && in_array(FilePath::TASKS,$files)){
          return true;
        }
        return false;
        
    }
    
    /**
     * Summary of create
     *
     * @return void
     */
    public function create(): void
    {
        if($this->isCreated() == false){
        $file = fopen(FilePath::TASKS,"w");
        fwrite($file,"{\n\n}");
        fclose($file);
        }

    }
    
    /**
     * Summary of content
     *
     * @return array<string>
     */
    public function content(): array
    {

        return file_exists(FilePath::TASKS) ? json_decode(file_get_contents(FilePath::TASKS),true) : [];
        
    }

}