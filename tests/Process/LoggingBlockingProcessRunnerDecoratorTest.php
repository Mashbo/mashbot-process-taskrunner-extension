<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tests\Process;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\CommandResult;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\BlockingProcessRunner;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\LoggingBlockingProcessRunnerDecorator;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;

class LoggingBlockingProcessRunnerDecoratorTest extends \PHPUnit_Framework_TestCase
{
    public function test_log_is_made_then_result_of_decoration_returned()
    {
        $runner     = $this->prophesize(BlockingProcessRunner::class);
        $logger     = $this->prophesize(LoggerInterface::class);
        $command    = new Command("ls");

        $runner->runBlockingProcess($command, "/tmp")->shouldBeCalled()->willReturn(new CommandResult(0, '', ''));

        $sut = new LoggingBlockingProcessRunnerDecorator($runner->reveal(), $logger->reveal());
        $result = $sut->runBlockingProcess($command, "/tmp", null);
        
        $logger->debug("Running command ls from directory /tmp")->shouldHaveBeenCalled();

        $this->assertEquals(new CommandResult(0, '', ''), $result);
    }
}
