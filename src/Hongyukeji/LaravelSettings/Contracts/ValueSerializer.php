<?php

namespace Hongyukeji\LaravelSettings\Contracts;

interface ValueSerializer
{
    /**
     * Serialize value.
     *
     * @param mixed $value
     * @return mixed
     */
    public function serialize($value);

    /**
     * Unserialize value.
     *
     * @param mixed $serialized
     * @return mixed
     */
    public function unserialize($serialized);
}
