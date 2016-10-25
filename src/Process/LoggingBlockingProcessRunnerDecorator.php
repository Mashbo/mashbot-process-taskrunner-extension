<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Psr\Log\LoggerInterface;

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

    public function runBlockingProcess(Command $command, $workingDirectory, $timeout = null, $outputCallback = null)
    {
        $this->logger->info(sprintf('Running command %s from directory %s', $command->getCommandLine(), $workingDirectory));
        return $this->processRunner->runBlockingProcess($command, $workingDirectory, $timeout, $outputCallback);
    }
}
