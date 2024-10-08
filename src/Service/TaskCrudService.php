<?php declare(strict_types=1);

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

use Exception;
use Entity\Task;
use Config\JsonFile;
use Enumeration\Message;
use Enumeration\FilePath;
use Enumeration\TaskCommand;

/**
 * Summary of TaskManagerCrud
 */
interface TaskManagerCrud
{
    public function create(mixed $value): ?bool;
    public function findAll(): void;
    public function findOne(int $id): ?array;
    public function findBy(string $command);
    public function update(mixed $value): ?bool;
    public function delete(mixed $id): ?bool;
    public function markInProgressOrDoneATask(mixed $array): ?bool;
}



class TaskCrudService implements TaskManagerCrud
{
    /**
     * Summary of __construct
     *
     * @param JsonFile $jsonFile
     * @param Task $task
     */
    public function __construct(private JsonFile $jsonFile, private Task $task)
    {
    }

    /**
     * Summary of create
     *
     * @param string $taskValue
     *
     * @return bool
     */
    public function create(mixed $taskValue): ?bool
    {
        if(is_string($taskValue)) {

            $this->handleDataForCreate($taskValue);
            $stdOut = fopen('php://stdout', 'a');
            fwrite($stdOut, Message::TASK_ADDED_SUCCESSFULLY.$this->task->getId().")\n\n");
            fclose($stdOut);
            return true;
        }
        return null;
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
        $this->task->setStatus("todo");
        $this->task->setCreatedAt();
        $this->task->setUpdatedAt();

        $dataFromUserInput = [];
        $dataFromUserInput["id"] = $this->task->getId();
        $dataFromUserInput["description"] = $this->task->getDescription();
        $dataFromUserInput["status"] = $this->task->getStatus();
        $dataFromUserInput["createdAt"] = $this->task->getCreatedAt();
        $dataFromUserInput["updatedAt"] = $this->task->getUpdatedAt();

        $originalDataArray = $this->jsonFile->content();
        array_push($originalDataArray, $dataFromUserInput);

        $json = json_encode($originalDataArray);
        file_put_contents(FilePath::TASKS, $json);
    }

    /**
     * Summary of update
     *
     * @param mixed $arrWithIdAndTaskNameToUpdated
     *
     * @return bool
     */
    public function update(mixed $arrWithIdAndTaskNameToUpdated): ?bool
    {
        if(is_array($arrWithIdAndTaskNameToUpdated)) {

            $id = current($arrWithIdAndTaskNameToUpdated);
            $taskDescription = $arrWithIdAndTaskNameToUpdated[1];
            $taskToUpdate = $this->findOne(current($arrWithIdAndTaskNameToUpdated));

            $taskToUpdate["description"]  = $taskDescription;
            $taskToUpdate["updatedAt"]  = date('Y-m-d');

            $dataUpdated = $this->updateDataInOriginalArrayOfTasks($id, $this->jsonFile->content(), $taskToUpdate);
            $json = json_encode($dataUpdated);
            file_put_contents(Filepath::TASKS, $json);

            $stdOut = fopen('php://stdout', 'a');
            fwrite($stdOut, " ".Message::TASK_UPDATED_SUCCESSFULLY.$id.")\n\n");
            fclose($stdOut);
            return true;
        }
        return null;
    }

    /**
     * Summary of updateDataInOriginalArrayOfTasks
     *
     * @param int $id
     * @param array<string> $arrOfOriginalData
     * @param array<string> $arrOfDataUpdated
     *
     * @return array<string>
     */
    public function updateDataInOriginalArrayOfTasks(int $id, array $arrayOfOriginalData, array $arrOfDataUpdated): array
    {

        foreach($arrayOfOriginalData as $k => $originalData) {
            if($originalData["id"] == $id) {
                $arrayOfOriginalData[$k] = $arrOfDataUpdated;
            }
        }
        return $arrayOfOriginalData;
    }



    /**
     * Summary of findOne
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return array<string>
     */
    public function findOne(int $id): ?array
    {
        foreach($this->jsonFile->content() as $task) {
            if($task["id"] == $id) {
                return $task;
            }
        }
        throw new Exception(Message::TASK_NOT_FOUND.$id.Message::TASK_NOT_FOUND_END);
    }

    /**
     * Summary of findAll
     *
     * @return void
     */
    public function findAll(): void
    {

        $tasks = $this->jsonFile->content();
        if(empty($tasks)) {
            throw new Exception(Message::TASKS_NOT_FOUND); 
        }
        foreach($tasks as $task) {
            $stdOut = fopen('php://stdout', 'a');
            fwrite($stdOut, "\n  ID : ".$task["id"]." - Description : ".$task["description"]." - Created the : ".$task["createdAt"]." - Status : ".$task["status"]."\n\n");
            fclose($stdOut);
        }


    }

    /**
     * Summary of delete
     *
     * @param mixed $arrWithIdAndIfGivenNameOfTheCommand
     *
     * @return bool|null
     */
    public function delete(mixed $arrWithIdAndIfGivenNameOfTheCommand): bool|null
    {

        $id = current($arrWithIdAndIfGivenNameOfTheCommand);
        $taskToDelete = $this->findOne($id);

        if(is_array($taskToDelete)) {

            $arrayOfOriginalData = $this->jsonFile->content();
            foreach($arrayOfOriginalData as $k => $task) {
                if($task["id"] == $id) {
                    unset($arrayOfOriginalData[$k]);
                }
            }

            $json = json_encode(array_values($arrayOfOriginalData));
            file_put_contents(FilePath::TASKS, $json);

            $stdOut = fopen('php://stdout', 'a');
            fwrite($stdOut, " ".Message::TASK_DELETED_SUCCESSFULLY);
            fclose($stdOut);

            return true;
        }
        return null;
    }


    /**
     * Summary of markInProgressOrDoneATask
     *
     * @param mixed $arrWithIdAndIfGivenNameOfTheCommand
     *
     * @return bool|null
     */
    public function markInProgressOrDoneATask(mixed $arrWithIdAndIfGivenNameOfTheCommand): ?bool
    {

        $id = current($arrWithIdAndIfGivenNameOfTheCommand);
        $taskToMark = $this->findOne($id);
        $inProgressOrDone = $arrWithIdAndIfGivenNameOfTheCommand[1] == TaskCommand::MARK_IN_PROGRESS ? "in-progress" : "done";
        if(is_array($taskToMark)) {

            $id = current($arrWithIdAndIfGivenNameOfTheCommand);

            $taskToMark["status"] = $inProgressOrDone;
            $taskToMark["updatedAt"] = date('Y-m-d');
            $arrayOfOriginalData = $this->jsonFile->content();

            foreach($arrayOfOriginalData as $k => $task) {
                if($task["id"] == $id) {
                    $arrayOfOriginalData[$k] = $taskToMark;
                }
            }

            $json = json_encode(array_values($arrayOfOriginalData));
            file_put_contents(FilePath::TASKS, $json);

            $successfullyMessageToDisplay = $arrWithIdAndIfGivenNameOfTheCommand[1] == TaskCommand::MARK_IN_PROGRESS ? Message::TASK_MARK_AS_IN_PROGRESS_SUCCESSFULLY : Message::TASK_MARK_AS_DONE_SUCCESSFULLY;
            $stdOut = fopen('php://stdout', 'a');
            fwrite($stdOut, " ".$successfullyMessageToDisplay);
            fclose($stdOut);

            return true;
        }
        return null;
    }


    /**
     * Summary of findBy
     *
     * @param string $command
     *
     * @throws \Exception
     *
     * @return void
     */
    public function findBy(string $command): void
    {
        $tasks = $this->jsonFile->content();
        $tasksFilterByTheCommand = array_filter($tasks,fn($task) => $task['status'] == $command);
        if(empty($tasksFilterByTheCommand)){
            throw new Exception(" ".Message::TASK_CLI_LABEL.Message::NO_TASKS_FOUND_WITH_THE_STATUS_ASK);
        }
        foreach($tasksFilterByTheCommand as $task) {
                $stdOut = fopen('php://stdout', 'a');
                fwrite($stdOut, "\n  ID : ".$task["id"]." - Description : ".$task["description"]." - Created the : ".$task["createdAt"]." - Status : ".$task["status"]."\n\n");
                fclose($stdOut);
        }
    }


}
