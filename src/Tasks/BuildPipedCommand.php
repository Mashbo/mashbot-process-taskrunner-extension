<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;

class BuildPipedCommand
{
    public function __invoke(Command $from, Command $to)
    {
        return new Command($from->getCommandLine() . " | " . $to->getCommandLine());
    }
}
