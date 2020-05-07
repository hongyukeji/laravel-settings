<?php

namespace Hongyukeji\LaravelSettings\Settings;

use Hongyukeji\LaravelSettings\Context;
use Hongyukeji\LaravelSettings\Contracts\ContextSerializer as ContextSerializerContract;

class ContextSerializer implements ContextSerializerContract
{
    public function serialize(Context $context = null)
    {
        return $context ? json_encode($context, JSON_UNESCAPED_UNICODE) : '';
    }
}