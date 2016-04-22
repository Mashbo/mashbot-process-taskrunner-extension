<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process;

use Symfony\Component\Process\Process;

class SymfonyProcessRunner implements BlockingProcessRunner
{

    public function runBlockingProcess(Process $process)
    {
        $process->mustRun();
    }
}
