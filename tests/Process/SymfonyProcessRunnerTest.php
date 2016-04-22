<?php

namespace Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Tests\Process;

use Mashbo\Mashbot\Extensions\ProcessTaskRunnerExtension\Process\SymfonyProcessRunner;
use Symfony\Component\Process\Process;

class SymfonyProcessRunnerTest extends \PHPUnit_Framework_TestCase
{
    public function test_it_returns_process_after_execution()
    {
        $sut = new SymfonyProcessRunner();
        $result = $sut->runBlockingProcess(new Process("echo hello"));

        $this->assertInstanceOf(Process::class, $result);
        $this->assertEquals(0, $result->getExitCode());
    }
}