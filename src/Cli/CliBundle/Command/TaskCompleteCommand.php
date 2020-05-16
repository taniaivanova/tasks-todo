<?php

namespace Cli\CliBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TodoTasks\Application\Task\Command;
use TodoTasks\Application\Task\Exception\TaskCannotBeSavedException;
use TodoTasks\Domain\Exception\TaskNameIsAlreadyExistedException;
use TodoTasks\Domain\Exception\TaskNameIsEmptyException;
use TodoTasks\Domain\Exception\TaskNotFoundException;

/**
 * Class TaskCompleteCommand
 *
 * @category None
 * @package  Cli\CliBundle\Command
 */
class TaskCompleteCommand extends ContainerAwareCommand
{
    /**
     * TaskCommand
     *
     * @var Command
     */
    protected $taskCommand;

    /**
     * TaskListCommand constructor
     *
     * @param Command $taskCommand Task Command
     *
     * @throws LogicException
     */
    public function __construct(Command $taskCommand)
    {
        $this->taskCommand = $taskCommand;

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
     * @throws InvalidArgumentException
     */
    protected function configure()
    {
        try {
            $this
                ->setName('task:complete')
                ->setDescription('...')
                ->addArgument('id', InputArgument::REQUIRED, 'Task ID');
        } catch (InvalidArgumentException $e) {
            // no catch exception
        }
    }

    /**
     * Execute
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return void
     * @throws TaskNotFoundException
     * @throws TaskCannotBeSavedException
     * @throws InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $taskId = $input->getArgument('id');
        } catch (InvalidArgumentException $e) {
            throw $e;
        }

        try {
            $this->taskCommand->completeTask($taskId);

            $output->writeln('Task marked completed');
        } catch (TaskNotFoundException | TaskCannotBeSavedException $e) {
            throw $e;
        }

    }

}
