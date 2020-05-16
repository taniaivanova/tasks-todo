<?php
/**
 * File: TaskNameIsAlreadyExistedException.php - todo
 * zzz - 03/02/17 14:49
 * PHP Version 7
 *
 * @category None
 * @package  TodoTasks
 */

namespace TodoTasks\Domain\Exception;

/**
 * Class TaskNameIsAlreadyExistedException
 *
 * An exception triggers when we try to have a task with the name
 * which is already used for another task
 *
 * @category None
 * @package  TodoTasks\Domain\Exception
 */
class TaskNameIsAlreadyExistedException extends \Exception
{

}
