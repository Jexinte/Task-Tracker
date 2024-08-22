<?php

/**
 * PHP version 8.
 *
 * @category Service
 * @package  TaskManagerService
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

namespace Service;

use Exception;
use Entity\Task;
use Config\JsonFile;
use Enumeration\Color;
use Enumeration\Message;
use Service\TaskCrudService;
use Enumeration\TaskCommand;
use Service\ErrorCheckerService;

require_once __DIR__ . "../../../vendor/autoload.php";


class TaskManagerService
{
    public bool $aCommandHaventBeenChose = false;

    /**
     * Summary of __construct
     * @param ErrorCheckerService $errorCheckerService
     * @param TaskCrudService $taskCrudService
     */
    public function __construct(private ErrorCheckerService $errorCheckerService,private TaskCrudService $taskCrudService){}

    /**
     * Summary of welcomeMessageWithCommandsAvailable
     *
     * @return void
     */
    public function welcomeMessageWithCommandsAvailable(): void
    {
        $stdout = fopen('php://stdout', 'w');
        fwrite($stdout, Message::WELCOME . implode('', Message::COMMANDS));
        fclose($stdout);
    }

    /**
     * Summary of startOfTheProgram
     * 
     * @return void
     */
    public function startOfTheProgram():void
    {
        $this->welcomeMessageWithCommandsAvailable();

        while (!$this->aCommandHaventBeenChose) {
            $streamToOutputTaskCliLabel = fopen('php://stdout', 'w');


            fwrite($streamToOutputTaskCliLabel," ".Message::TASK_CLI_LABEL.COLOR::YELLOW);
            
            $streamInput = fopen('php://stdin', "w");


            try {
                $this->detectCommand(Message::TASK_CLI_LABEL.COLOR::YELLOW, trim(fgets($streamInput)));
            } catch (Exception $e) {
            $stdErr = fopen("php://stderr", "w");
            fwrite($stdErr, $e->getMessage());
            fclose($stdErr);
            }
            fclose($streamToOutputTaskCliLabel);
        }
    }
    

    /**
     * Summary of detectCommand
     * 
     * @param string $taskCliLabel
     * @param string $value
     * 
     * @throws \Exception
     * 
     * @return void
     */
    public function detectCommand(string $taskCliLabel, string $value): void
    {
        foreach (TaskCommand::ALL_OF_THEM as $command) {
            if (str_contains($value, $command)) {
                $this->chooseWhichActionToExecuteDependingOnTheCommand($value,$command);
                return;
            }
        }
        throw new Exception(" ".$taskCliLabel.Message::WRONG_COMMAND);
    }


    /**
     * Summary of chooseWhichActionToExecuteDependingOnTheCommand
     * 
     * @param string $value
     * @param string $command
     * 
     * @throws \Exception
     * 
     * @return void
     */
    public function chooseWhichActionToExecuteDependingOnTheCommand(string $value, string $command):void
    {
        switch($command){
            case TaskCommand::ADD:
                $taskCreated = $this->taskCrudService->create($this->errorCheckerService->onAddCommandValues($value));
                if($taskCreated){
                    return;
                }
                throw new Exception(" ".Message::TASK_NAME_FOR_THE_ADD_COMMAND_HAS_NOT_BEEN_SUPPLIED);
            case TaskCommand::UPDATE:
                $taskUpdated = $this->taskCrudService->update($this->errorCheckerService->onUpdateCommandValues($value));
                if($taskUpdated){
                    return;
                }
               throw new Exception(" ".Message::TASK_NAME_FOR_THE_UPDATE_COMMAND_HAS_NOT_BEEN_SUPPLIED);

            case TaskCommand::DELETE:
                $taskDeleted = $this->taskCrudService->delete($this->errorCheckerService->onDeleteCommandValues($value));
                if($taskDeleted){
                    return;
                }
        }

    }
    
}

try {
    
$errorChecker = new ErrorCheckerService();
$jsonFile = new JsonFile();
$task = new Task($jsonFile);
$taskCrudService = new TaskCrudService($jsonFile,$task);

$taskManagerService = new TaskManagerService($errorChecker,$taskCrudService);
$taskManagerService->startOfTheProgram();
} catch (Exception $e) {
    $stdErr = fopen("php://stderr", "w");
    fwrite($stdErr, $e->getMessage());
    fclose($stdErr);
}

