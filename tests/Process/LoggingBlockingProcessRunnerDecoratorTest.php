<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tests\Process;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\BlockingProcessRunner;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\LoggingBlockingProcessRunnerDecorator;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;

class LoggingBlockingProcessRunnerDecoratorTest extends \PHPUnit_Framework_TestCase
{
    public function test_log_is_made_then_result_of_decoration_returned()
    {
        $runner     = $this->prophesize(BlockingProcessRunner::class);
        $logger     = $this->prophesize(LoggerInterface::class);
        $process    = $this->prophesize(Process::class);

        $runner->runBlockingProcess($process)->shouldBeCalled()->willReturn($process);

        $process->getCommandLine()->willReturn("ls");
        $process->getWorkingDirectory()->willReturn("/tmp");

        $sut = new LoggingBlockingProcessRunnerDecorator($runner->reveal(), $logger->reveal());
        $result = $sut->runBlockingProcess($process->reveal());
        
        $logger->debug("Running command ls from directory /tmp")->shouldHaveBeenCalled();

        $this->assertSame($process->reveal(), $result);
    }
}
