<?php

/**
 * PHP version 8.
 *
 * @category Exceptions
 * @package  ValidationException
 * @author   Yokke <mdembelepro@gmail.com>
 * @license  ISC License
 * @link     https://github.com/Jexinte/Task-Tracker
 */

namespace Exceptions;

use Exception;


class ValidationException extends Exception
{
    /**
     * Summary of errors
     * 
     * @var array<string>
     */
    protected array $errors = [];


    /**
     * Summary of setTypeAndValueOfException
     * 
     * @param string $key
     * 
     * @param string $message
     * 
     * @return ValidationException
     */
    public function setTypeAndValueOfException(
        string $key, 
        string $message
    ): ?ValidationException {
        $this->errors[$key] = $message;
        return $this;
    }
    

    /**
     * Summary of getErrors
     * 
     * @return array<string>
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
}