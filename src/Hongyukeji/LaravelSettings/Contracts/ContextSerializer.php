<?php

namespace Hongyukeji\LaravelSettings\Contracts;

use Hongyukeji\LaravelSettings\Context;

interface ContextSerializer
{
    /**
     * Serialize context into a string representation.
     *
     * @param \Hongyukeji\LaravelSettings\Context $context
     * @return string
     */
    public function serialize(Context $context = null);
}
