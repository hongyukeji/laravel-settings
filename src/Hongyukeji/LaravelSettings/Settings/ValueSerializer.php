<?php

namespace Hongyukeji\LaravelSettings\Settings;

use Hongyukeji\LaravelSettings\Contracts\ValueSerializer as ValueSerializerContract;

class ValueSerializer implements ValueSerializerContract
{
    public function serialize($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function unserialize($serialized)
    {
        return json_decode($serialized, true);
    }
}
