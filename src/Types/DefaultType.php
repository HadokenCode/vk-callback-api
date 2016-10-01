<?php

namespace cjmaxik\VKCallbackAPI\Types;

class DefaultType
{
    public $default;

    public function __construct($object)
    {
        $this->default = $object;
    }
}
