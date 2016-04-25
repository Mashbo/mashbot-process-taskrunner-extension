<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tests\Command;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_encapsulates_process_details()
    {
        $command = new Command("ls -la");
        $this->assertEquals("ls -la", $command->getCommandLine());
    }
}
