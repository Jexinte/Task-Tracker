<?php declare(strict_types=1);

namespace Enumeration;

/**
 * PHP version 8.
 *
 * @category Enumeration
 * @package  Regex
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

enum Regex: string
{
    public const TASK = '/^"[a-zA-z\d\s]+"$/';
    public const NUMBERS = '/\d+/';
    public const ON_LIST_COMMAND_FOR_ALL_TASKS = '/^list$/';
}
