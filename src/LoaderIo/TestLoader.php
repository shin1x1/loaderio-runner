<?php
namespace Shin1x1\LoaderIo;

/**
 * Class TestLoader
 * @package Shin1x1\LoaderIo
 */
class TestLoader
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @param Client
     * @throws \Exception
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws \Exception
     * @return TestCollection
     */
    public function load()
    {
        $result = $this->client->tests();

        $tests = new TestCollection();
        foreach ($result as $test) {
            if (!preg_match('/^[0-9]+\./', $test->name, $m)) {
                continue;
            }

            $tests[] = new Test($this->client, $test);
        }
        $tests->sort();

        return $tests;
    }
}
