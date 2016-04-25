<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tests\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\Command;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Command\CommandResult;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\BlockingProcessRunner;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks\RunSynchronousProcess;
use Mashbo\Mashbot\TaskRunner\Tests\Functional\TaskTest;

class RunSynchronousProcessTest extends TaskTest
{
    private $processRunner;

    public function setUp()
    {
        $this->processRunner = $this->getMockBuilder(BlockingProcessRunner::class)->getMock();
        return parent::setUp();

    }

    /**
     * @return callable
     */
    protected function getTask()
    {
        return new RunSynchronousProcess($this->processRunner);
    }

    public function test_command_is_run_via_process_command()
    {
        $this->runner->invoke('process:command:build', ['command' => 'ls -a1'])->shouldBeCalled()->willReturn(new Command('ls -a1'));

        $this->processRunner
            ->expects($this->once())
            ->method('runBlockingProcess')
            ->with(new Command("ls -a1"), '/tmp')
            ->will($this->returnValue(new CommandResult(0, ".\n..", '')))
        ;

        $result = $this->invoke(['command' => "ls -a1", 'directory' => '/tmp']);

        $this->assertSame(['stdout' => ".\n..", 'stderr' => '', 'status' => 0], $result);
    }

    public function test_command_object_can_be_passed_directly()
    {
        $this->processRunner
            ->expects($this->once())
            ->method('runBlockingProcess')
            ->with(new Command("ls -a1"), '/tmp')
            ->will($this->returnValue(new CommandResult(0, ".\n..", '')))
        ;

        $result = $this->invoke(['command' => new Command("ls -a1"), 'directory' => '/tmp']);

        $this->assertSame(['stdout' => ".\n..", 'stderr' => '', 'status' => 0], $result);
    }

}
