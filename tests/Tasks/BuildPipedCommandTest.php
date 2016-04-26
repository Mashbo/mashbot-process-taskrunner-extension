<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tests\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks\BuildPipedCommand;

class BuildPipedCommandTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_pipes_from_to_to()
    {
        $sut = new BuildPipedCommand;
        $this->assertEquals(new Command("ls -la | grep file"), $sut->__invoke(new Command('ls -la'), new Command('grep file')));
    }

    public function test_commands_can_be_passed_as_strings()
    {
        $sut = new BuildPipedCommand();
        $this->assertEquals(new Command("ls -la | grep file"), $sut->__invoke('ls -la', 'grep file'));
    }
}