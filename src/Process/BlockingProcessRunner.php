<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process;

use Symfony\Component\Process\Process;

interface BlockingProcessRunner
{
    /**
     * @param Process $process
     * @return Process
     */
    public function runBlockingProcess(Process $process);
}