<?php
/**
 * File: TaskNotFoundException.php - todo
 * zzz - 03/02/17 13:37
 * PHP Version 7
 *
 * @category None
 * @package  TodoTasks
 */

namespace TodoTasks\Domain\Exception;

/**
 * Class TaskNotFoundException
 *
 * An exception triggers when we try to find a Task which is not existed
 * in Task repository
 *
 * @category None
 * @package  TodoTasks\Domain\Exception
 */
class TaskNotFoundException extends \Exception
{

}
