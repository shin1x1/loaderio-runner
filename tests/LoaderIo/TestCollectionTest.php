<?php
namespace Shin1x1\LoaderIo\Test;

use Phake;
use PHPUnit_Framework_TestCase;
use Shin1x1\LoaderIo\Client;
use Shin1x1\LoaderIo\Test;
use Shin1x1\LoaderIo\TestCollection;

/**
 * Class TestCollectionTest
 * @package Shin1x1\LoaderIo\Test
 */
class TestCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function run_test()
    {
        $client = Phake::mock(Client::class);

        Phake::when($client)->run('test_id1')->thenReturn('result_id1');

        $result = (object)[
            'status' => 'ready',
            'success' => 999,
        ];
        Phake::when($client)->result('test_id1', 'result_id1')->thenReturn($result);

        $sut = new TestCollection();
        $sut[] = new Test($client, (object)['name' => 'test1', 'test_id' => 'test_id1'], false);
        $actual = $sut->run();

        $this->assertSame(1, count($actual));
        $this->assertSame('test1', $actual[0]->name);
        $this->assertSame(999, $actual[0]->success);
    }
}