<?php

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


enum TaskCommand {

    const ADD = "add";

    const UPDATE = "update";

    const DELETE = "delete";

    const MARK_IN_PROGRESS = "mark-in-progress";

    const MARK_DONE = "mark-done";

    const LIST_OF_ALL = "list";

    const LIST_OF_ALL_DONE = "list done";

    const LIST_OF_ALL_TODO = "list todo";

    const LIST_IN_PROGRESS = "list in progress";
    const LIST_OF_COMMANDS = "list commands";

    const ALL_OF_THEM = [self::ADD,self::UPDATE,self::DELETE,self::MARK_IN_PROGRESS,self::MARK_DONE,self::LIST_OF_ALL,self::LIST_OF_ALL_DONE,self::LIST_OF_ALL_TODO,self::LIST_IN_PROGRESS,self::LIST_OF_COMMANDS];
}