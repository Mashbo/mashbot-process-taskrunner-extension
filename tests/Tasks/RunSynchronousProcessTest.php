<?php

namespace Mashbo\Mashbot\Extensions\SshTaskRunnerExtension\Tests\Tasks;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\BlockingProcessRunner;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks\RunSynchronousProcess;
use Symfony\Component\Process\Process;

class RunSynchronousProcessTest extends \PHPUnit_Framework_TestCase
{
    public function test_command_is_run_via_process_command()
    {
        $processRunner = $this->getMockBuilder(BlockingProcessRunner::class)->getMock();
        
        $completedProcess = $this
            ->getMockBuilder(Process::class)
            ->disableOriginalConstructor()
            ->getMock();
        $completedProcess->method('getOutput')->willReturn(".\n..");
        $completedProcess->method('getErrorOutput')->willReturn('');
        $completedProcess->method('getExitCode')->willReturn(0);

        $processRunner
            ->expects($this->once())
            ->method('runBlockingProcess')
            ->with(
                $this->callback(
                    function (Process $process) {
                        return $process->getCommandLine() == "ls -a1";
                    }
                )
            )
            ->will($this->returnValue($completedProcess))
        ;

        $sut = new RunSynchronousProcess($processRunner);
        $result = $sut->__invoke("ls -a1");

        $this->assertSame(['stdout' => ".\n..", 'stderr' => '', 'status' => 0], $result);
    }

}
