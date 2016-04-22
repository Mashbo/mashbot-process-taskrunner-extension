<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\BlockingProcessRunner;
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
        $taskRunner->add('process:run', new RunSynchronousProcess($this->processRunner));
    }
}