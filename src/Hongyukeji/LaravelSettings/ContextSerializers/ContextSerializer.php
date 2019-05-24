<?php

namespace Hongyukeji\LaravelSettings\ContextSerializers;

use Hongyukeji\LaravelSettings\Context;
use Hongyukeji\LaravelSettings\Contracts\ContextSerializer as ContextSerializerContract;

class ContextSerializer implements ContextSerializerContract
{
    /**
     * Serialize context into a string representation.
     *
     * @param \Hongyukeji\LaravelSettings\Context $context
     * @return string
     */
    public function serialize(Context $context = null)
    {
        return serialize($context);
    }
}
