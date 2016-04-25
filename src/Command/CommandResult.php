<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command;

class CommandResult
{
    private $exitCode;

    /**
     * @var string
     */
    private $stdOut;

    /**
     * @var string
     */
    private $stdErr;

    public function __construct($exitCode, $stdOut, $stdErr)
    {
        if (!is_integer($exitCode)) {
            throw new \LogicException("Exit code must be an integer");
        }
        $this->exitCode = $exitCode;
        $this->stdOut = $stdOut;
        $this->stdErr = $stdErr;
    }

    /**
     * @return string
     */
    public function getStdErr()
    {
        return $this->stdErr;
    }

    /**
     * @return integer
     */
    public function getExitCode()
    {
        return $this->exitCode;
    }

    /**
     * @return string
     */
    public function getStdOut()
    {
        return $this->stdOut;
    }
}