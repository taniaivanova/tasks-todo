<?php
/**
 *
 * @category None
 * @package  TodoTasks
 */

namespace TodoTasks\Domain\Repository;

use TodoTasks\Application\Task\Exception\TaskCannotBeRemovedException;
use TodoTasks\Application\Task\Exception\TaskCannotBeSavedException;
use TodoTasks\Domain\Exception\TaskNotFoundException;
use TodoTasks\Domain\Task;

/**
 * Interface TaskRepositoryInterface
 *
 * Provide access to Task repository
 *
 * @category None
 * @package  TodoTasks\Domain\Repository
 */
interface TaskRepositoryInterface
{
    /**
     * Find all Tasks
     *
     * @return array
     */
    public function findAll(): array;

    /**
     * Find a Task from given ID
     *
     * @param mixed $id Id
     *
     * @return Task
     * @throws TaskNotFoundException
     */
    public function find($id): Task;

    /**
     * Find all Tasks from given status
     *
     * @param mixed $status Status
     *
     * @return array
     */
    public function findAllByStatus($status): array;

    /**
     * Find a Task from given name
     *
     * @param string $name Name
     *
     * @return Task
     * @throws TaskNotFoundException
     */
    public function findByName(string $name): Task;

    /**
     * Save Task object into repository
     *
     * @param Task $task Task
     *
     * @return void
     * @throws TaskCannotBeSavedException
     */
    public function save(Task $task);

    /**
     * Remove a Task from repository
     *
     * @param Task $task Task
     *
     * @return void
     * @throws TaskCannotBeRemovedException
     */
    public function remove(Task $task);

    /**
     * Remove Tasks which have given status
     *
     * @param mixed $status Status
     *
     * @return void
     * @throws TaskCannotBeRemovedException
     */
    public function removeByStatus($status);

}
