<?php
namespace Shin1x1\LoaderIo;

use stdClass;

class Test
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var stdClass
     */
    protected $test;

    /**
     * @var bool
     */
    protected $output = true;

    /**
     * @param Client $client
     * @param stdClass $test
     * @param bool $output
     */
    public function __construct(Client $client, stdClass $test, $output = true)
    {
        $this->client = $client;
        $this->test = $test;
        $this->output = $output;
    }

    /**
     * @return null|\stdClass
     */
    public function run()
    {
        $resultId = $this->client->run($this->test->test_id);

        $this->output($this->test->name . ' ');

        for ($i = 0; $i <= 20; $i++) {
            $result = $this->client->result($this->test->test_id, $resultId);
            if ($result->status === 'ready') {
                $this->output(PHP_EOL);
                $result->name = $this->test->name;
                return $result;
            }

            $this->output('.');
            sleep(10);
        }

        return null;
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

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return isset($this->test->$name) ? $this->test->$name : null;
    }
}