<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command;

class Command
{
    private $cmd;

    public function __construct($commandString)
    {
        $this->cmd = $commandString;
    }

    /**
     * @return string
     */
    public function getCommandLine()
    {
        return $this->cmd;
    }
}
