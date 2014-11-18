<?php
namespace Shin1x1\LoaderIo;

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * Class TestCollection
 * @package Shin1x1\LoaderIo
 */
class TestCollection implements ArrayAccess, Countable, IteratorAggregate
{
    use ArrayTrait;

    /**
     * @var string
     */
    protected $arrayType = Test::class;

    /**
     * @var Test[]
     */
    protected $array = [];

    /**
     * @param array $tests
     */
    public function __construct(array $tests = null)
    {
        $this->array = $tests;
    }

    /**
     * @return ResultCollection
     */
    public function run()
    {
        $results = new ResultCollection();

        foreach ($this->array as $test) {
            $result = $test->run();
            $results[] = new Result($result);
        }

        return $results;
    }

    /**
     *
     */
    public function sort()
    {
        if (empty($this->array)) {
            return;
        }

        usort($this->array, function ($a, $b) {
            return $a->name > $b->name;
        });
    }
}