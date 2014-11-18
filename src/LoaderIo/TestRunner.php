<?php
namespace Shin1x1\LoaderIo;

/**
 * Class TestRunner
 * @package Shin1x1\LoaderIo
 */
class TestRunner
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var array
     */
    protected $tests = [];

    /**
     * @var bool
     */
    protected $output = true;

    /**
     * @param Client $client
     * @param array $tests
     * @param bool $output
     */
    public function __construct(Client $client, array $tests, $output = true)
    {
        $this->client = $client;
        $this->tests = $tests;
        $this->output = $output;
    }

    /**
     * @return array
     */
    public function run()
    {
        $this->results = [];

        foreach ($this->tests as $test) {
            $resultId = $this->client->run($test->test_id);

            $this->output($test->name . ' ');

            for ($i = 0; $i <= 20; $i++) {
                $result = $this->client->result($test->test_id, $resultId);
                if ($result->status === 'ready') {
                    $this->results[] = $result;
                    break;
                }

                $this->output('.');
                sleep(10);
            }

            $this->output(PHP_EOL);
        }

        return $this->results;
    }

    /**
     * @param string $message
     */
    protected function output($message)
    {
        if ($this->output) {
            echo $message;
        }
    }
}