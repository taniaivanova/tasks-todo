<?php
/**
 *
 * @category None
 * @package  TodoTasks
 */

namespace TodoTasks\Domain\Service;
use TodoTasks\Domain\Exception\TaskNameIsAlreadyExistedException;
use TodoTasks\Domain\Exception\TaskNameIsEmptyException;
use TodoTasks\Domain\Repository\TaskRepositoryInterface;
use TodoTasks\Domain\Specification\TaskNameIsNotEmptySpecification;
use TodoTasks\Domain\Specification\TaskNameIsUniqueSpecification;

/**
 * Class TaskValidationService
 *
 * Validates Task object to make sure we have valid Task before working
 *
 * @category None
 * @package  TodoTasks\Domain\Service
 */
class TaskValidationService
{
    /**
     * TaskRepository
     *
     * @var TaskRepositoryInterface
     */
    protected $taskRepository;

    /**
     * TaskValidationService constructor
     *
     * @param TaskRepositoryInterface $taskRepository
     *
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        // Inject Repository object
        $this->taskRepository = $taskRepository;
    }

    /**
     * Validate a Task object by name
     *
     * @param string $name Name
     * @param mixed  $id   ID
     *
     * @return bool
     * @throws TaskNameIsEmptyException
     * @throws TaskNameIsAlreadyExistedException
     */
    public function validateName(string $name, $id = null): bool
    {
        // Task's name should not be empty
        $emptyNameValidator = new TaskNameIsNotEmptySpecification();
        if (!$emptyNameValidator->isSatisfiedBy($name)) {
            throw new TaskNameIsEmptyException("Task's name should not be empty.");
        }

        // Task's name should be unique
        $uniqueNameValidator = new TaskNameIsUniqueSpecification(
            $this->taskRepository
        );
        if (!$uniqueNameValidator->isSatisfiedBy($name, $id)) {
            throw new TaskNameIsAlreadyExistedException(
                "Task's name $name is already existed"
            );
        }

        return true;
    }

}