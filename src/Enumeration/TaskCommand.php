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

    const LIST = "list";

    const LIST_DONE = "list done";

    const LIST_TODO = "list todo";

    const LIST_IN_PROGRESS = "list in progress";
}