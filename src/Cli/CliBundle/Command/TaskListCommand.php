<?php

namespace Cli\CliBundle\Command;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use TodoTasks\Application\Task\Query;
use TodoTasks\Domain\Task;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TaskListCommand
 *
 * @category None
 * @package  Cli\CliBundle\Command
 */
class TaskListCommand extends ContainerAwareCommand
{
    /**
     * TaskQuery
     *
     * @var Query
     */
    protected $taskQuery;

    /**
     * TaskListCommand constructor
     *
     * @param Query $taskQuery Task Query
     *
     * @throws LogicException
     */
    public function __construct(Query $taskQuery)
    {
        $this->taskQuery = $taskQuery;

        try {
            parent::__construct();
        } catch (LogicException $e) {
            throw $e;
        }
    }

    /**
     * Configure
     *
     * @return void
     */
    protected function configure()
    {
        try {
            $this
                ->setName('task:list')
                ->setDescription('...');
        } catch (InvalidArgumentException $e) {
            // no catch exception
        }
    }

    /**
     * Execute
     *
     * @param InputInterface  $input  Input
     * @param OutputInterface $output Output
     *
     * @return void
     * @throws LogicException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            parent::execute($input, $output);
        } catch (LogicException $e) {
            // no catch
        }

        $output->writeln('Remaining');

        $remainingTasks = $this->taskQuery->getAllRemainingTasks();

        /** @var Task $task */
        foreach ($remainingTasks as $task) {
            $output->writeln($task->getId() . ' - ' . $task->getName() . '');
        }

        $output->writeln('');

        $output->writeln('Completed');

        $completedTasks = $this->taskQuery->getAllCompletedTasks();

        foreach ($completedTasks as $task) {
            $output->writeln($task->getId() . ' - ' . $task->getName());
        }
    }

}
