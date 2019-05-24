<?php

namespace Hongyukeji\LaravelSettings\Contracts;

use Hongyukeji\LaravelSettings\Context;

interface KeyGenerator
{
    /**
     * Generate storage key for a given key and context.
     *
     * @param string $key
     * @param \Hongyukeji\LaravelSettings\Context $context
     * @return string
     */
    public function generate($key, Context $context = null);
}
