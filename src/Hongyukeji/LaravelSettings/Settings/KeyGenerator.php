<?php

namespace Hongyukeji\LaravelSettings\Settings;

use Hongyukeji\LaravelSettings\Context;
use Hongyukeji\LaravelSettings\Contracts\ContextSerializer;
use Hongyukeji\LaravelSettings\Contracts\KeyGenerator as KeyGeneratorContract;

class KeyGenerator implements KeyGeneratorContract
{
    protected $serializer;

    public function __construct(ContextSerializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function generate($key, Context $context = null)
    {
        return $key . $this->serializer->serialize($context);
    }
}
