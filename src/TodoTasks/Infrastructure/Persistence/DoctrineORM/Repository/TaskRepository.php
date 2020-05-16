<?php

namespace TodoTasks\Infrastructure\Persistence\DoctrineORM\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMInvalidArgumentException;
use TodoTasks\Application\Task\Exception\TaskCannotBeRemovedException;
use TodoTasks\Application\Task\Exception\TaskCannotBeSavedException;
use TodoTasks\Domain\Exception\TaskNotFoundException;
use TodoTasks\Domain\Repository\TaskRepositoryInterface;
use TodoTasks\Domain\Task;

/**
 * Class TaskRepository
 *
 * @category None
 * @package  TodoTasks\Infrastructure\Persistence\DoctrineORM\Repository
 */
class TaskRepository extends EntityRepository implements TaskRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return parent::findAll();
    }/** @noinspection PhpSignatureMismatchDuringInheritanceInspection */

    /**
     * @inheritDoc
     */
    public function find($id): Task
    {
        /** @var Task $task */
        $task = parent::find($id);

        if ($task === null) {
            throw new TaskNotFoundException("Cannot find task with id $id");
        }

        return $task;
    }

    /**
     * @inheritDoc
     */
    public function findAllByStatus($status): array
    {
        return $this->findBy(
            [
            'status' => $status
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function findByName(string $name): Task
    {
        /** @var Task $task */
        $task = $this->findOneBy(
            [
                'name' => $name
            ]
        );

        if ($task === null) {
            throw new TaskNotFoundException("Cannot find task with name $name");
        }

        return $task;
    }

    /**
     * @inheritDoc
     */
    public function save(Task $task): bool
    {
        if ($task->getCreatedAt() === null) {
            $task->setCreatedAt(new \DateTime());
        }
        $task->setUpdatedAt(new \DateTime());

        try {
            $this->getEntityManager()->persist($task);
        } catch (ORMInvalidArgumentException $e) {
            throw new TaskCannotBeSavedException($e->getMessage());
        }

        try {
            $this->getEntityManager()->flush();
        } catch (OptimisticLockException $e) {
            throw new TaskCannotBeSavedException($e->getMessage());
        }


        return true;
    }

    /**
     * @inheritDoc
     */
    public function remove(Task $task): bool
    {
        try {
            $this->getEntityManager()->remove($task);
        } catch (ORMInvalidArgumentException $e) {
            throw new TaskCannotBeRemovedException($e->getMessage());
        }

        try {
            $this->getEntityManager()->flush();
        } catch (OptimisticLockException $e) {
            throw new TaskCannotBeRemovedException($e->getMessage());
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function removeByStatus($status): bool
    {
        $query = $this->getEntityManager()
            ->createQuery('DELETE FROM TodoTasks\Domain\Task t WHERE t.status = :status');
        $query->setParameter('status', $status);
        $query->execute();

        return true;
    }

}
