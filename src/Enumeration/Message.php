<?php declare(strict_types=1);

namespace Enumeration;

use Enumeration\Color;

require __DIR__."../../../vendor/autoload.php";

/**
 * PHP version 8.
 *
 * @category Enumeration
 * @package  Message
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

enum Message: string
{
    public const TASK_CLI_LABEL = Color::GREEN."task-cli ";
    public const WELCOME = "\n\n Welcome to TaskMaster, your personal task management assistant! Here to help you stay organized and on top of your to-dos.\n\n Below is the list of available commands:\n\n";
    public const COMMAND_ADD_EXAMPLE = PHP_EOL.Color::GREY."# Adding a new task\n\n"." ".self::TASK_CLI_LABEL.Color::YELLOW."add ".'"Buy groceries"'.PHP_EOL.PHP_EOL.Color::GREY."# Output: Task added successfully (ID: 1)\n\n";

    public const COMMAND_UPDATE_EXAMPLE = PHP_EOL.Color::GREY."# Updating and deleting a task\n\n"." ".self::TASK_CLI_LABEL.Color::YELLOW."update ".COLOR::PURPLE. 1 .COLOR::YELLOW.' "Buy groceries and cook dinner"'.PHP_EOL;

    public const COMMAND_DELETE_EXAMPLE = " ".self::TASK_CLI_LABEL.Color::YELLOW."delete ".COLOR::PURPLE. 1 .PHP_EOL.PHP_EOL;

    public const COMMAND_MARK_IN_PROGRESS_EXAMPLE = " ".PHP_EOL.Color::GREY."# Marking a task as in progress or done\n\n"." ".self::TASK_CLI_LABEL.Color::YELLOW."mark-in-progress ".COLOR::PURPLE. 1 .PHP_EOL;
    public const COMMAND_MARK_DONE_EXAMPLE = " ".self::TASK_CLI_LABEL.Color::YELLOW."mark-done ".COLOR::PURPLE. 1 .PHP_EOL.PHP_EOL;

    public const COMMAND_LISTS_TASKS_EXAMPLE = PHP_EOL.Color::GREY."# Listing all tasks\n\n"." ".self::TASK_CLI_LABEL.Color::YELLOW."list".PHP_EOL.PHP_EOL;
    public const COMMAND_LISTS_BY_STATUS_EXAMPLE = PHP_EOL.Color::GREY."# Listing tasks by status\n\n"." ".self::TASK_CLI_LABEL.Color::YELLOW."list done"."\n"." ".self::TASK_CLI_LABEL.Color::YELLOW."list todo"."\n ".self::TASK_CLI_LABEL.Color::YELLOW."list in-progress".PHP_EOL.PHP_EOL;

    public const COMMAND_LISTS_OF_COMMANDS_EXAMPLE = PHP_EOL.Color::GREY."# Listing all commands\n\n"." ".self::TASK_CLI_LABEL.Color::YELLOW."list commands\n\n\n";

    public const TASK_NOT_FOUND = " ".self::TASK_CLI_LABEL.COLOR::RED."The task with the ID : ";
    public const TASK_NOT_FOUND_END = " doesn't exist, please specify a valid one ! \n";
    public const WRONG_COMMAND = Color::RED."Please, type a valid command \n";

    public const TASK_NAME_FOR_THE_ADD_COMMAND_HAS_NOT_BEEN_SUPPLIED = self::TASK_CLI_LABEL.COLOR::RED.'Please specify a task with quotes next to add in order to register it. Only letters from a to z and numbers are accepted !'.PHP_EOL;
    public const TASK_NAME_FOR_THE_UPDATE_COMMAND_HAS_NOT_BEEN_SUPPLIED = self::TASK_CLI_LABEL.COLOR::RED.'Please specify an ID for the task that you want to update then the name of the updated task with quotes. Only letters from a to z and numbers are accepted !'.PHP_EOL;

    public const TASK_ID_REQUIRED_TO_EXECUTE_THE_COMMAND = self::TASK_CLI_LABEL.COLOR::RED.'Please specify an ID next to the command in order to execute it !'.PHP_EOL;


    public const TASK_ADDED_SUCCESSFULLY = "\n ".Color::GREY." Task added successfully (ID: ";
    public const TASK_UPDATED_SUCCESSFULLY = "\n ".Color::GREY." Task updated successfully (ID: ";
    public const TASK_DELETED_SUCCESSFULLY = "\n".Color::GREY."  Task deleted successfully\n\n";
    public const TASK_MARK_AS_IN_PROGRESS_SUCCESSFULLY = "\n".Color::GREY.'  Task mark as "in-progress" successfully'.PHP_EOL.PHP_EOL;
    public const TASK_MARK_AS_DONE_SUCCESSFULLY = "\n".Color::GREY.'  Task mark as "done" successfully'.PHP_EOL.PHP_EOL;
    public const LIST_COMMAND_FOR_ALL_TASK_HAS_NOT_BEEN_SUPPLIED = Color::RED.'Please, if you wanna see all tasks use the command "list" or another type of tasks list look at the table of commands ! '.PHP_EOL;
    public const LIST_COMMAND_MISS_ANOTHER_ONE_TO_BE_EXECUTED = Color::RED.'Please, in order to show a specific list of task you have to add one of the following : "done", "todo", "in-progress" or "commands"'.PHP_EOL;
    public const TASKS_NOT_FOUND = " ".self::TASK_CLI_LABEL.Color::RED."No tasks have been found ! Try to create one ! \n";

    public const NO_TASKS_FOUND_WITH_THE_STATUS_ASK = Color::RED.'No tasks have been found with the status supplied !'.PHP_EOL;
    public const COMMANDS = [self::COMMAND_ADD_EXAMPLE,self::COMMAND_UPDATE_EXAMPLE,self::COMMAND_DELETE_EXAMPLE,self::COMMAND_MARK_IN_PROGRESS_EXAMPLE,self::COMMAND_MARK_DONE_EXAMPLE,self::COMMAND_LISTS_TASKS_EXAMPLE,self::COMMAND_LISTS_BY_STATUS_EXAMPLE];

    public const TASK_DONE = "done";
    public const TASK_TODO = "todo";
    public const TASK_IN_PROGRESS = "in-progress";

}
