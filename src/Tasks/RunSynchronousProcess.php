<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\BlockingProcessRunner;
use Symfony\Component\Process\Process;

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

    public function __invoke($command, $directory = null, $timeout = null) {

        $process = new Process($command, $directory);
        if (!is_null($timeout)) {
            $process->setTimeout($timeout);
        }
        if (0 === $timeout) {
            $process->setTimeout(null);
        }

        $completedProcess = $this->processRunner->runBlockingProcess($process);
        return [
            'status' => $completedProcess->getStatus(),
            'stdout' => $completedProcess->getOutput(),
            'stderr' => $completedProcess->getErrorOutput()
        ];
    }
}