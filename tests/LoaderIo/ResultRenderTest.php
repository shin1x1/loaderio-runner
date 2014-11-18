<?php
namespace Shin1x1\LoaderIo\Test;

use PHPUnit_Framework_TestCase;
use Shin1x1\LoaderIo\ResultCollection;
use Shin1x1\LoaderIo\ResultRender;

class ResultRenderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function render()
    {
        $tests = new ResultCollection([
            (object)[
                'name' => 'test1',
                'success' => 10,
                'error' => 1,
                'timeout_error' => 2,
                'network_error' => 3,
                'avg_response_time' => 4.4,
                'avg_error_rate' => 5.55,
                'public_results_url' => 'http://example.org/test1',
            ],
        ]);
        $sut = new ResultRender($tests);

        $output = <<<EOT

name,success,error,timeout_error,network_error,avg_response_time,avg_error_rate,public_results_url
test1,10,1,2,3,4.4,5.55,http://example.org/test1

EOT;
        $this->expectOutputString($output);

        echo $sut->render();
    }
}