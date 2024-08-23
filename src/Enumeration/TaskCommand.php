<?php declare(strict_types=1);

/**
 * PHP version 8.
 *
 * @category Enumeration
 * @package  TaskCommand
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

namespace Enumeration;

enum TaskCommand
{
    public const ADD = "add";

    public const UPDATE = "update";

    public const DELETE = "delete";

    public const MARK_IN_PROGRESS = "mark-in-progress";

    public const MARK_DONE = "mark-done";

    public const LIST_OF_ALL_TASKS = "list";

    public const LIST_OF_ALL_DONE = "list done";

    public const LIST_OF_ALL_TODO = "list todo";

    public const LIST_IN_PROGRESS = "list in-progress";
    public const LIST_OF_COMMANDS = "list commands";

    public const ALL_OF_THEM = [self::ADD,self::UPDATE,self::DELETE,self::MARK_IN_PROGRESS,self::MARK_DONE,self::LIST_OF_ALL_TASKS,self::LIST_OF_ALL_DONE,self::LIST_OF_ALL_TODO,self::LIST_IN_PROGRESS,self::LIST_OF_COMMANDS];
}
