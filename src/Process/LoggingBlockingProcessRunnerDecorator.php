<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process;

use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;

class LoggingBlockingProcessRunnerDecorator implements BlockingProcessRunner
{
    /**
     * @var BlockingProcessRunner
     */
    private $processRunner;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(BlockingProcessRunner $processRunner, LoggerInterface $logger)
    {
        $this->processRunner = $processRunner;
        $this->logger = $logger;
    }

    public function runBlockingProcess(Process $process)
    {
        $this->logger->debug(sprintf('Running command %s from directory %s', $process->getCommandLine(), $process->getWorkingDirectory()));
        $this->processRunner->runBlockingProcess($process);
    }
}
