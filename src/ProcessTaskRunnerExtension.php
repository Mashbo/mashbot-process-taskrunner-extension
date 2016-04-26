<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\BlockingProcessRunner;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks\BuildCommand;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks\BuildPipedCommand;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks\RunSynchronousProcess;
use Mashbo\Mashbot\TaskRunner\TaskRunner;
use Mashbo\Mashbot\TaskRunner\TaskRunnerExtension;

class ProcessTaskRunnerExtension implements TaskRunnerExtension
{
    /**
     * @var BlockingProcessRunner
     */
    private $processRunner;

    public function __construct(BlockingProcessRunner $processRunner)
    {
        $this->processRunner = $processRunner;
    }

    public function amendTasks(TaskRunner $taskRunner)
    {
        $taskRunner->add('process:command:run',     new RunSynchronousProcess($this->processRunner));
        $taskRunner->add('process:command:build',   new BuildCommand());
        $taskRunner->add('process:pipe',            new BuildPipedCommand());
    }
}
