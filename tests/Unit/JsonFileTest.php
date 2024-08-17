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

class JsonFileTest extends TestCase
{

    private JsonFile $jsonFile;
    /**
     * Summary of jsonFile
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->jsonFile = new JsonFile();
    }

    

    /**
     * Summary of testShouldReturnFalseIfFileNotCreated
     *
     * @return void
     */
    public function testShouldReturnFalseIfFileNotCreated(): void
    {
        if(file_exists(FilePath::TASKS))
        {
            unlink(FilePath::TASKS);
        }
        $this->assertSame(false, $this->jsonFile->isCreated());
    }

    /**
     * Summary of testShouldReturnTrueIfFileIsCreated
     * 
     * @return void
     */
    public function testShouldReturnTrueIfFileIsCreated(): void
    {
        $this->jsonFile->create();
        $this->assertSame(true, $this->jsonFile->isCreated());
    }

    /**
     * Summary of testShouldReturnAJsonFile
     *
     * @return void
     */
    public function testShouldReturnAJsonFile(): void
    {
        $this->jsonFile->create();
        $this->assertFileExists(FilePath::TASKS);
    }

    /**
     * Summary of testShouldReturnAnEmptyArrayWhenFileDoesntExist
     *
     * @return void
     */
    public function testShouldReturnAnEmptyArrayWhenFileDoesntExist(): void
    {
        if(file_exists(FilePath::TASKS))
        {
            unlink(FilePath::TASKS);
        }
        $this->assertSame([], $this->jsonFile->content());
    }

    /**
     * Summary of testShouldReturnTheSameAmountOfElementsBetweenOriginalDataAndDataSavedInJsonFile
     * 
     * @return void
     */
    public function testShouldReturnTheSameAmountOfElementsBetweenOriginalDataAndDataSavedInJsonFile(): void
    {
        $this->jsonFile->create();
        
        $data = [
            [
                "id" => 1,
                "description" => "Lorem ipsum",
                "status" => "done",
                "createdAt" => date('Y-m-d'),
                "updatedAt" => null
            ],
            [
                "id" => 2,
                "description" => "Lorem ipsum",
                "status" => "todo",
                "createdAt" => date('Y-m-d'),
                "updatedAt" => null
            ],
            [
                "id" => 3,
                "description" => "Lorem ipsum",
                "status" => "in-progress",
                "createdAt" => date('Y-m-d'),
                "updatedAt" => null
            ],
        ];
        if (file_exists(FilePath::TASKS)) {
            $jsonData = json_encode($data);
            file_put_contents(FilePath::TASKS, $jsonData);
        }

        $this->assertCount(count($data), $this->jsonFile->content());
    }

    /**
     * Summary of testShouldReturnTheSameAmountOfDataw
     * 
     * @return void
     */
    public function testShouldReturnTheSameAmountOfData(): void
    {

        $data = [
            [
                "id" => 4,
                "description" => "Lorem ipsum",
                "status" => "in-progress",
                "createdAt" => date('Y-m-d'),
                "updatedAt" => null
            ],
            [
                "id" => 5,
                "description" => "Lorem ipsum",
                "status" => "todo",
                "createdAt" => date('Y-m-d'),
                "updatedAt" => null
            ],
            [
                "id" => 6,
                "description" => "Lorem ipsum",
                "status" => "done",
                "createdAt" => date('Y-m-d'),
                "updatedAt" => null
            ],
        ];
        if (file_exists(FilePath::TASKS)) {
            $jsonOriginalData = $this->jsonFile->content();
            $updatedData = array_merge($jsonOriginalData, $data);
            file_put_contents(FilePath::TASKS, json_encode($updatedData));
        }

        $data = json_decode(file_get_contents(FilePath::TASKS),true);
        $this->assertCount(count($data), $this->jsonFile->content());
    }
}
