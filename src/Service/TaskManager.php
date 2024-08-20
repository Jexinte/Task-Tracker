<?php

/**
 * PHP version 8.
 *
 * @category Service
 * @package  TaskManager
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

namespace Service;

use Enumeration\TaskCommand;
use Enumeration\Color;
use Enumeration\Message;
use Exception;

require_once __DIR__ . "../../../vendor/autoload.php";

class TaskManager
{
    public bool $aCommandHaventBeenChose = false;

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
    public function startOfTheProgram()
    {
        $this->welcomeMessageWithCommandsAvailable();

        while (!$this->aCommandHaventBeenChose) {
            $streamToOutputTaskCliLabel = fopen('php://stdout', 'w');

            fwrite($streamToOutputTaskCliLabel, " " . Message::TASK_CLI_LABEL . COLOR::YELLOW);

            $streamInput = fopen('php://stdin', "w");
            try {
                $this->detectCommand(" " . Message::TASK_CLI_LABEL . COLOR::YELLOW, trim(fgets($streamInput)));
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
     * @param mixed $taskCliLabel
     * @param mixed $value
     * 
     * @throws \Exception
     * 
     * @return void
     */
    public function detectCommand($taskCliLabel, $value): void
    {
        foreach (TaskCommand::ALL_OF_THEM as $command) {
            if (str_contains($value, $command)) {
                $this->aCommandHaventBeenChose = true;
                return;
            }
        }
        throw new Exception($taskCliLabel . "Please, type a valid command : \n");
    }
}

try {
    $taskManager = new TaskManager();
   $taskManager->startOfTheProgram();
} catch (Exception $e) {
    $stdErr = fopen("php://stderr", "w");
    fwrite($stdErr, $e->getMessage());
    fclose($stdErr);
}
