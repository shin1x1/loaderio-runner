<?php
namespace Shin1x1\LoaderIo;

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * Class ResultCollection
 * @package Shin1x1\LoaderIo
 */
class ResultCollection implements ArrayAccess, Countable, IteratorAggregate
{
    use ArrayTrait;

    /**
     * @var string
     */
    protected $arrayType = Result::class;

    /**
     * @var Result[]
     */
    protected $array = [];

    /**
     * @param array $results
     */
    public function __construct(array $results = null)
    {
        $this->array = $results;
    }
}