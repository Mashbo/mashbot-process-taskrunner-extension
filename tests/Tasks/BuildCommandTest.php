<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tests\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks\BuildCommand;

class BuildCommandTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_builds_command()
    {
        $sut = new BuildCommand;
        $this->assertEquals(new Command('ls -la'), $sut->__invoke('ls -la'));
    }
}