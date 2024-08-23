<?php declare(strict_types=1);

/**
 * PHP version 8.
 *
 * @category Enumeration
 * @package  FilePath
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

namespace Enumeration;

enum FilePath: string
{
    public const TASKS = __DIR__."../../../config/tasks.json";
}
