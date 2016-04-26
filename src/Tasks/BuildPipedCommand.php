<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;

class BuildPipedCommand
{
    /**
     * @param Command|string $from
     * @param Command|string $to
     * @return Command
     */
    public function __invoke($from, $to)
    {
        if (is_string($from)) {
            $from = new Command($from);
        }

        if (is_string($to)) {
            $to = new Command($to);
        }

        return new Command($from->getCommandLine() . " | " . $to->getCommandLine());
    }
}
