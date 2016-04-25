<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tests\Command;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\CommandResult;

class CommandResultTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_holds_exit_code()
    {
        $sut = new CommandResult(0, 'OUTPUT', 'ERROR');
        $this->assertEquals(0,          $sut->getExitCode());
        $this->assertEquals('OUTPUT',   $sut->getStdOut());
        $this->assertEquals('ERROR',    $sut->getStdErr());
    }
}