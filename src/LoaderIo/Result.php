<?php
namespace Shin1x1\LoaderIo;

use stdClass;

/**
 * Class Result
 * @package Shin1x1\LoaderIo
 */
class Result
{
    /**
     * @var stdClass
     */
    protected $result;

    /**
     * @param stdClass $result
     */
    public function __construct(stdClass $result)
    {
        $this->result = $result;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return isset($this->result->$name) ? $this->result->$name : null;
    }
}