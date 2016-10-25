<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\CommandResult;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Exceptions\ProcessFailedException;
use Symfony\Component\Process\Process;

class SymfonyProcessRunner implements BlockingProcessRunner
{
    public function runBlockingProcess(Command $command, $workingDirectory, $timeout = null, $outputCallback = null)
    {
        $process = new Process($command->getCommandLine());
        $process->setWorkingDirectory($workingDirectory);

        $process->setTimeout($timeout);

        $process->start();

        $process->wait($outputCallback);

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process->getCommandLine(), $process->getExitCode());
        }

        return new CommandResult($process->getExitCode(), $process->getOutput(), $process->getErrorOutput());
    }
}
