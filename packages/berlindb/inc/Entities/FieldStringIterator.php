<?php

namespace LaunchpadBerlinDB\Entities;

use Iterator;

class FieldStringIterator implements Iterator
{

    /**
     * @var string
     */
    protected $value;

    /**
     * @var string|boolean
     */
    protected $part;

    /**
     * @var int
     */
    protected $index;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
        $this->rewind();
    }


    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->part;
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->part = strtok(':');
        $this->index ++;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return is_string($this->part);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->part = strtok($this->value, ':');
        $this->index = 1;
    }
}
