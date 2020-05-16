<?php

namespace TodoTasks\Domain\Specification;

/**
 * Class TaskNameIsNotEmptySpecification
 *
 * A specification describes that Task's name should not be empty
 *
 * @category None
 * @package  TodoTasks\Domain\Specification
 */
class TaskNameIsNotEmptySpecification
{
    /**
     * Check given name is empty or not, we want it not empty
     *
     * @param string $name Name
     *
     * @return bool
     */
    public function isSatisfiedBy(string $name)
    {
        return $name !== '';
    }
}
