<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\BlockingProcessRunner;
use Mashbo\Mashbot\TaskRunner\TaskContext;

class RunSynchronousProcess
{
    /**
     * @var BlockingProcessRunner
     */
    private $processRunner;

    public function __construct(BlockingProcessRunner $processRunner)
    {
        $this->processRunner = $processRunner;
    }

    public function __invoke(TaskContext $context, $command, $directory, $timeout = null)
    {
        if (is_string($command)) {
            $command = $context->taskRunner()->invoke('process:command:build', ['command' => $command]);
        }
        if (!($command instanceof Command)) {
            throw new \LogicException("Command argument must be either a string or " . Command::class . " object");
        }

        $commandResult = $this->processRunner->runBlockingProcess($command, $directory, $timeout);

        return [
            'stdout' => $commandResult->getStdOut(),
            'stderr' => $commandResult->getStdErr(),
            'status' => $commandResult->getExitCode(),
        ];
    }
}