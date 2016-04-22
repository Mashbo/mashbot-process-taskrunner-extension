<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tests;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\BlockingProcessRunner;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\ProcessTaskRunnerExtension;
use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tasks\RunSynchronousProcess;
use Mashbo\Mashbot\TaskRunner\TaskRunner;

class ProcessTaskRunnerExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testItAddsTasks()
    {
        $taskRunner = $this
            ->getMockBuilder(TaskRunner::class)
            ->disableOriginalConstructor()
            ->getMock();
        $processRunner = $this
            ->getMockBuilder(BlockingProcessRunner::class)
            ->getMock();


        $taskRunner
            ->expects($this->once())
            ->method('add')
            ->with('process:run', $this->callback(function($arg) {
                return $arg instanceof RunSynchronousProcess;
            }));

        $sut = new ProcessTaskRunnerExtension($processRunner);
        $sut->amendTasks($taskRunner);
    }
}
