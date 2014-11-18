<?php
namespace Shin1x1\LoaderIo\Test;

use Phake;
use PHPUnit_Framework_TestCase;
use Shin1x1\LoaderIo\Client;
use Shin1x1\LoaderIo\TestLoader;

/**
 * Class TestLoaderTest
 * @package Shin1x1\LoaderIo\Test
 */
class TestLoaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function load()
    {
        $json = file_get_contents(__DIR__ . '/tests.json');
        $tests = json_decode($json);

        $client = Phake::mock(Client::class);
        Phake::when($client)->tests()->thenReturn($tests);

        $sut = new TestLoader($client);
        $actual = $sut->load();

        $this->assertSame(3, count($actual));
        $this->assertSame('1. test1', $actual[0]->name);
        $this->assertSame('2. test2', $actual[1]->name);
        $this->assertSame('3. test3', $actual[2]->name);
    }

    /**
     * @test
     */
    public function loadNoTests()
    {
        $tests = [];

        $client = Phake::mock(Client::class);
        Phake::when($client)->tests()->thenReturn($tests);

        $sut = new TestLoader($client);
        $actual = $sut->load();

        $this->assertSame(0, count($actual));
    }
}