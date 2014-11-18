<?php
namespace Shin1x1\LoaderIo;

use ArrayIterator;
use Iterator;

/**
 * Class ArrayTrait
 * @package Shin1x1\LoaderIo
 * @property string $arrayType
 * @property array $array
 */
trait ArrayTrait
{
    /**
     * @param mixed $offset <p>
     * @return boolean true on success or false on failure.
     */
    public function offsetExists($offset)
    {
        return isset($this->array[$offset]);
    }

    /**
     * @param mixed $offset <p>
     * @return Test
     */
    public function offsetGet($offset)
    {
        return isset($this->array[$offset]) ? $this->array[$offset] : null;
    }

    /**
     * @param mixed $offset <p>
     * @param Test $value <p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (!is_object($value) || !($value instanceof $this->arrayType)) {
            throw new \InvalidArgumentException();
        }

        if (is_null($offset)) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset <p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->array);
    }

    /**
     * @return Iterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->array);
    }
}