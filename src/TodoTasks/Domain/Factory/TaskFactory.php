<?php

namespace TodoTasks\Domain\Factory;

use TodoTasks\Domain\Exception\TaskNameIsAlreadyExistedException;
use TodoTasks\Domain\Exception\TaskNameIsEmptyException;
use TodoTasks\Domain\Repository\TaskRepositoryInterface;
use TodoTasks\Domain\Service\TaskValidationService;
use TodoTasks\Domain\Specification\TaskNameIsNotEmptySpecification;
use TodoTasks\Domain\Specification\TaskNameIsUniqueSpecification;
use TodoTasks\Domain\Task;

/**
 * Class TaskFactory
 *
 * A factory to create Task object
 *
 * @category None
 * @package  TodoTasks\Domain\Factory
 */
class TaskFactory
{
    /**
     * TaskRepository
     *
     * @var TaskRepositoryInterface
     */
    protected $taskRepository;

    /**
     * TaskValidationService
     *
     * @var TaskValidationService
     */
    protected $taskValidationService;

    /**
     * TaskFactory constructor
     *
     * @param TaskRepositoryInterface $taskRepository
     *
     */
    public function __construct(
        TaskRepositoryInterface $taskRepository
    ) {
        // Inject Repository
        $this->taskRepository = $taskRepository;

        // Init Validation service
        $this->taskValidationService = new TaskValidationService($this->taskRepository);
    }


    /**
     * Create Task object from name
     *
     * @param string $name Name
     *
     * @return Task
     * @throws TaskNameIsAlreadyExistedException
     * @throws TaskNameIsEmptyException
     */
    public function createFromName(string $name) : Task
    {
        // First we create a blank Task object
        $task = new Task();

        // Then we need to make sure the Task's name is not empty and not used
        // by another Task
        try {
            $this->taskValidationService->validateName($name);
        } catch (TaskNameIsEmptyException | TaskNameIsAlreadyExistedException $e) {
            throw $e;
        }

        // When we are sure the name is ok, just set the name
        $task->setName($name);

        // Return Task object
        return $task;
    }


}
