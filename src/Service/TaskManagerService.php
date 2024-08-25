<?php declare(strict_types=1);

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
    public bool $userHaventStopTheProgram = false;

    /**
     * Summary of __construct
     * @param ErrorCheckerService $errorCheckerService
     * @param TaskCrudService $taskCrudService
     */
    public function __construct(private ErrorCheckerService $errorCheckerService, private TaskCrudService $taskCrudService)
    {
    }

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
    public function startOfTheProgram(): void
    {
        $this->welcomeMessageWithCommandsAvailable();

        while (!$this->userHaventStopTheProgram) {
            $streamToOutputTaskCliLabel = fopen('php://stdout', 'w');


            fwrite($streamToOutputTaskCliLabel, " ".Message::TASK_CLI_LABEL.COLOR::YELLOW);

            $userInput = fopen('php://stdin', "w");

            try {
                $this->detectCommand(Message::TASK_CLI_LABEL.COLOR::YELLOW, trim(fgets($userInput)));
            } catch (Exception $e) {
                $stdErr = fopen("php://stderr", "w");
                fwrite($stdErr, $e->getMessage());
                fclose($stdErr);
            }
            fclose($streamToOutputTaskCliLabel);
            fclose($userInput);
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
        $command = "";
        $checkIfTheUserInputMatchOneOfTheCommandAvailable = array_filter(TaskCommand::ALL_OF_THEM, fn ($command) => substr($value, 0, strlen($command)) == $command);
        $ifTotalOccurrences = count($checkIfTheUserInputMatchOneOfTheCommandAvailable);
        $command = $ifTotalOccurrences == 2 ? next($checkIfTheUserInputMatchOneOfTheCommandAvailable) : current($checkIfTheUserInputMatchOneOfTheCommandAvailable);

        if(empty($command)) {
            throw new Exception(" ".$taskCliLabel.Message::WRONG_COMMAND);
        }
        $this->chooseWhichActionToExecuteDependingOnTheCommand($value, $command);
        return;
    }


    /**
     * Summary of chooseWhichActionToExecuteDependingOnTheCommand
     *
     * @param string $value
     * @param string $command
     *
     * @return void
     */
    public function chooseWhichActionToExecuteDependingOnTheCommand(string $value, string $command): void
    {
        switch($command) {
            case TaskCommand::ADD:
                $this->taskCrudService->create($this->errorCheckerService->onAddCommandValues($value));
                break;
            case TaskCommand::UPDATE:
                $this->taskCrudService->update($this->errorCheckerService->onUpdateCommandValues($value));
                break;

            case TaskCommand::DELETE:
                $this->taskCrudService->delete($this->errorCheckerService->onDeleteOrMarkInProgressOrMarkDoneCommandValues($value, TaskCommand::DELETE));
                break;
            case TaskCommand::MARK_IN_PROGRESS:
                $this->taskCrudService->markInProgressOrDoneATask($this->errorCheckerService->onDeleteOrMarkInProgressOrMarkDoneCommandValues($value, TaskCommand::MARK_IN_PROGRESS));
                break;

            case TaskCommand::MARK_DONE:
                $this->taskCrudService->markInProgressOrDoneATask($this->errorCheckerService->onDeleteOrMarkInProgressOrMarkDoneCommandValues($value, TaskCommand::MARK_DONE));
                break;
            case TaskCommand::LIST_OF_ALL_TASKS:
                $theCommandListIsAloneWithoutAnythingNextTo = $this->errorCheckerService->onListCommandWithoutAnythingElse($value);
                if($theCommandListIsAloneWithoutAnythingNextTo) {
                    $this->taskCrudService->findAll();
                }
                break;
            case TaskCommand::LIST_OF_ALL_DONE:
                $this->taskCrudService->findBy($this->errorCheckerService->onListCommandFollowByAnotherCommand($value, TaskCommand::LIST_OF_ALL_DONE, TaskCommand::LIST_OF_ALL_TODO, TaskCommand::LIST_IN_PROGRESS));
                break;

            case TaskCommand::LIST_IN_PROGRESS:
                $this->taskCrudService->findBy($this->errorCheckerService->onListCommandFollowByAnotherCommand($value, TaskCommand::LIST_OF_ALL_DONE, TaskCommand::LIST_OF_ALL_TODO, TaskCommand::LIST_IN_PROGRESS));
                break;

            case TaskCommand::LIST_OF_ALL_TODO:
                $this->taskCrudService->findBy($this->errorCheckerService->onListCommandFollowByAnotherCommand($value, TaskCommand::LIST_OF_ALL_DONE, TaskCommand::LIST_OF_ALL_TODO, TaskCommand::LIST_IN_PROGRESS));
                break;

        }

    }

}

try {

    $errorChecker = new ErrorCheckerService();
    $jsonFile = new JsonFile();
    $task = new Task($jsonFile);
    $taskCrudService = new TaskCrudService($jsonFile, $task);

    $taskManagerService = new TaskManagerService($errorChecker, $taskCrudService);
    $taskManagerService->startOfTheProgram();
} catch (Exception $e) {
    $stdErr = fopen("php://stderr", "w");
    fwrite($stdErr, $e->getMessage());
    fclose($stdErr);
}
