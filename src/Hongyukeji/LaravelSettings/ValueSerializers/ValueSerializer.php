<?php

namespace Hongyukeji\LaravelSettings\ValueSerializers;

use Hongyukeji\LaravelSettings\Contracts\ValueSerializer as ValueSerializerContract;

class ValueSerializer implements ValueSerializerContract
{
    /**
     * Serialize value.
     *
     * @param mixed $value
     * @return mixed
     */
    public function serialize($value)
    {
        return serialize($value);
    }

    /**
     * Unserialize value.
     *
     * @param mixed $serialized
     * @return mixed
     */
    public function unserialize($serialized)
    {
        return unserialize($serialized);
    }
}
