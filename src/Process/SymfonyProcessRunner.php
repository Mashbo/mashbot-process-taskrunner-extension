<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\CommandResult;
use Symfony\Component\Process\Process;

class SymfonyProcessRunner implements BlockingProcessRunner
{
    public function runBlockingProcess(Command $command, $workingDirectory, $timeout = null)
    {
        $process = new Process($command->getCommandLine());
        $process->setWorkingDirectory($workingDirectory);

        $process->setTimeout($timeout);

        $process->mustRun();

        return new CommandResult($process->getExitCode(), $process->getOutput(), $process->getErrorOutput());
    }
}
