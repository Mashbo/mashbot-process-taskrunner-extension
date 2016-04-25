<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;

class BuildCommand
{
    public function __invoke($command)
    {
        return new Command($command);
    }
}
