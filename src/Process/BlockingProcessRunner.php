<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\CommandResult;

interface BlockingProcessRunner
{
    /**
     * @param Command $command
     * @param $workingDirectory
     * @param int|null $timeout Timeout in seconds, or null for no limit
     * 
     * @return CommandResult
     */
    public function runBlockingProcess(Command $command, $workingDirectory, $timeout = null);
}
