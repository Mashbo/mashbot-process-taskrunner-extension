<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Exceptions;

class ProcessFailedException extends \RuntimeException
{
    public function __construct($command, $exitCode)
    {
        parent::__construct("Process failed with exit code $exitCode: $command");
    }
}